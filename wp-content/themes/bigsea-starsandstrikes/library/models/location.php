<?php

// Requires Coral Locations plugin.

function coralLocation_selectedLocation()
{
	$coralLocationHandler = coralLocations();
    $location = $coralLocationHandler->getLocation();
    
    // Use this model below instead of the default.
    return CoralLocationModel::fromWPPost($location->object);
}

class CoralLocationModel extends Coral\Locations\Models\Location
{
    public function getFeaturedPromotions()
    {
        if (isset($this->featuredPromotions)) return $this->featuredPromotions;

        $this->featuredPromotions = get_field('featured', $this->ID);

        return $this->featuredPromotions;
    }

    public function getSpecials()
    {
        if (isset($this->specials)) return $this->specials;

        $this->specials = get_field('specials', $this->ID);

        usort ($this->specials, array($this, 'sortByDayOfWeek'));
        
        return $this->specials;
    }

    public function getNotice()
    {
        if (isset($this->notice)) return $this->notice;

        $this->notice = get_field('notice', $this->ID);
        
        return $this->notice;
    }

    public function getAttractions()
    {
        if (isset($this->attractions)) return $this->attractions;

        $this->attractions = get_field('attractions', $this->ID);

        // Strip out anything not meant for general visibility.
        for ($i = 0; $i < count($this->attractions); $i++) {
            if (!get_field('show', $this->attractions[$i]->ID)) {
                unset($this->attractions[$i]);
            }
        }
        
        return $this->attractions;
    }

    public function getCTAs()
    {
        if (isset($this->ctas)) return $this->ctas;

        $this->ctas = get_field('location_cta', $this->ID);
        
        return $this->ctas;
    }

    public function getBirthdayPackages()
    {
        if (isset($this->packages)) return $this->packages;

        $this->packages = get_field('packages', $this->ID);

        return $this->packages;
    }

    public function getUpcomingSpecials($originalSelectedDay = null, $total = 3)
    {
        if ($originalSelectedDay === null) {
            $originalSelectedDay = date('w');
        }
        $originalSelectedDay = (int)$originalSelectedDay;
        $currentSelectedDay = (int)$originalSelectedDay;

        $specials = $this->getSpecials();
        $specialsResponse = [];
        $matchedSpecials = 0;

        // Never go through the loop more times than the total number of specials are event available.
        for ($attempts = 0; $attempts < count($specials) + 7; $attempts++) {
            $incrementCurrent = true;
            // Increment happens for every single foreach if matches found,
            //      but if never run, we need to run it for each attempt
            foreach ($specials as $special) {
                // If we got all we wanted, then we're good to go and can break out.
                if ($matchedSpecials >= $total) {
                    break;
                }

                if (
                    $special['day'] == $currentSelectedDay
                    && $special['active']
                ) {
                    // Current Day is in results, and is active
                    // Increment the count, but we're staying in the loop
                    //  If we're not done the loop yet, the next item will likely be needed.
                    $matchedSpecials++;
                    $incrementCurrent = false;
                    $currentSelectedDay = $this->incrementCount($currentSelectedDay);
                    $specialsResponse[] = $special;
                }
            }

            // Increment if no matches found the current loop
            if ($incrementCurrent) {
                $currentSelectedDay = $this->incrementCount($currentSelectedDay);
            }

            // We are back to the start. No point in continuing. Clearly no remaining matches.
            if ($currentSelectedDay == $originalSelectedDay) {
                break;
            }

            // Around and around we go.
        }

        return $specialsResponse;
    }
    
    private function incrementCount($count, $max = 6, $start = 0)
    {
        $count++;
        if ($count > $max) {
            $count = $start;
        }

        return $count;
    }

    private function sortByDayOfWeek($a, $b)
    {
        if ($a['day'] < $b['day']) return -1;
        if ($a['day'] > $b['day']) return 1;

        return 0;
    }

    public function getParsedMenu()
    {
        if (isset($this->menu)) return $this->menu;

        $this->menu = get_field('restaurant_menu', $this->ID);
        $this->menu->sections = null;
        if ($this->menu) {
            $this->menu->sections = get_field('sections', $this->menu->ID);
            foreach ($this->menu->sections as &$menuSection) {
                if (is_array($menuSection['menu_items'])) {
                    foreach ($menuSection['menu_items'] as &$item) {
                        $item->price = get_field('price', $item->ID);
                        $item->addons = get_field('addons', $item->ID);
                        $overrides = get_field('price_variations', $item->ID);
                        if ($overrides && count($overrides) > 0) {
                            foreach ($overrides as $override) {
                                if ($override['location']->ID == $this->ID) {
                                    $item->price = $override['price'];
                                    if ($override['override_addons']) {
                                        $item->addons = $override['addons'];
                                    }
                                }
                            }
                        } // endif hasOverrides

                        $item->hasAddons = false;
                        $item->hasAddonsPrices = false;
                        if ($item->addons && is_array($item->addons)) {
                            foreach ($item->addons as $addon) {
                                $item->hasAddons = true;
                                if ($addon['price'] && $addon['price'] != '') {
                                    $item->hasAddonsPrices = true;
                                    break;
                                }
                            }
                        }
                    } // endforeach menu_item
                } // endif is_array
            } // endforeach menuSection
        }

        return $this->menu;
    }

    public function getRestaurant()
    {
        $menu = $this->getParsedMenu();

        if ($menu) {
            $restaurantSlugs = wp_get_post_terms($menu->ID, 'menu-restaurant', array(
                'fields' => 'slugs',
            ));
            if ($restaurantSlugs && is_array($restaurantSlugs)) {
                return $restaurantSlugs[0];
            }
        }

        return null;
    }

    public static function fromWPPost($post)
    {
        if (!$post) {
            return null;
        }
        
        parent::fromWPPost($post);

        return new CoralLocationModel($post);
    }
}