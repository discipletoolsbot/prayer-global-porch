<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

class PG_Stacker_Positions {
    public static function _position_1( &$stack, $position = 1 ) {

        $images = pg_images( $stack['location']['grid_id'], true );

        if ( ! empty( $images['photos'] ) ) {

            $text_list = PG_Stacker_Text::photos_text( $stack );
            $text = $text_list[array_rand( $text_list ) ];

            $image_url = $images['photos'][array_rand( $images['photos'] )];
            $template = [
                'type' => 'photo_block',
                'data' => [
                    'section_label' => 'One Shot Prayer Walk',
                    'location_label' => 'Photo from the ' . $stack['location']['admin_level_name'] . ' of ' . $stack['location']['full_name'],
                    'url' => $image_url,
                    'section_summary' => $text['section_summary'],
                    'prayer' => $text['prayer'],
                ]
            ];

            if ( empty( $position ) ) {
                $stack['list'] = array_merge( [ $template ], $stack['list'] );
            } else {
                $stack['list'] = array_merge( array_slice( $stack['list'], 0, $position ), [ $template ], array_slice( $stack['list'], $position ) );
            }
        }

        return $stack;
    }

    public static function _position_2( &$stack, $position = 3 ) {

        $section_label = 'Faith Status';

        $templates = [];

        $templates[] = [
            'type' => 'percent_3_circles',
            'data' => [
                'section_label' => $section_label,
                'label_1' => "Don't Know Jesus",
                'percent_1' => $stack['location']['percent_non_christians'],
                'population_1' => $stack['location']['non_christians'],
                'label_2' => 'Know About Jesus',
                'percent_2' => $stack['location']['percent_christian_adherents'],
                'population_2' => $stack['location']['christian_adherents'],
                'label_3' => 'Know Jesus',
                'percent_3' => $stack['location']['percent_believers'],
                'population_3' => $stack['location']['believers'],
                'section_summary' => '',
                'prayer' => '',
            ]
        ];
        $templates[] = [
            'type' => '100_bodies_chart',
            'data' => [
                'section_label' => $section_label,
                'percent_1' => $stack['location']['percent_non_christians'],
                'percent_2' => $stack['location']['percent_christian_adherents'],
                'percent_3' => $stack['location']['percent_believers'],
                'pop_1' => $stack['location']['percent_non_christians'],
                'pop_2' => $stack['location']['percent_christian_adherents'],
                'pop_3' => $stack['location']['percent_believers'],
                'pop_1_label' => 'Non-Christians',
                'pop_2_label' => 'Cultural Christians',
                'pop_3_label' => 'Believers',
                'section_summary' => 'Non-Christians - '.$stack['location']['non_christians'].' | Cultural Christians - '.$stack['location']['christian_adherents'].' | Believers - '.$stack['location']['believers'].'',
                'prayer' => '',
            ]
        ];
        $templates[] = [
            'type' => '100_bodies_3_chart',
            'data' => [
                'section_label' => $section_label,
                'label_1' => "Don't know Jesus",
                'percent_1' => $stack['location']['percent_non_christians'],
                'population_1' => $stack['location']['non_christians'],
                'label_2' => "Know about Jesus",
                'percent_2' => $stack['location']['percent_christian_adherents'],
                'population_2' => $stack['location']['christian_adherents'],
                'label_3' => "Know Jesus",
                'percent_3' => $stack['location']['percent_believers'],
                'population_3' => $stack['location']['believers'],
                'section_summary' => '',
                'prayer' => '',
            ]
        ];
        $templates[] = [
            'type' => 'lost_per_believer',
            'data' => [
                'section_label' => $section_label,
                'label_1' => "One disciple of Jesus for every " . $stack['location']['lost_per_believer_int'] . " lost neighbors",
                'lost_per_believer' => $stack['location']['lost_per_believer_int'],
                'prayer' => '',
            ]
        ];

//        if ( $stack['location']['percent_non_christians'] < 85 ) {
//            $templates[] = [
//                'type' => 'percent_3_bar',
//                'data' => [
//                    'section_label' => $section_label,
//                    'label_1' => "Don't",
//                    'percent_1' => $stack['location']['percent_non_christians'],
//                    'population_1' => $stack['location']['non_christians'],
//                    'label_2' => 'Know About',
//                    'percent_2' => $stack['location']['percent_christian_adherents'],
//                    'population_2' => $stack['location']['christian_adherents'],
//                    'label_3' => 'Know',
//                    'percent_3' => $stack['location']['percent_believers'],
//                    'population_3' => $stack['location']['believers'],
//                    'section_summary' => 'Non-Christians - '.$stack['location']['non_christians'].' | Cultural Christians - '.$stack['location']['christian_adherents'].' | Believers - '.$stack['location']['believers'].'',
//                    'prayer' => '',
//                ]
//            ];
//        }

        // begin demographic birth and death section
        // @note this section produces only one template addition.
        $types = [ 'births', 'deaths' ];
        $type = $types[array_rand( $types )];
        $names = [ 'Father', 'Spirit', 'Jesus', 'Lord' ];
        $name = $names[array_rand( $names )];
        if ( 'christian_adherents' === $stack['location']['favor'] && 'deaths' === $type ) {
            if ( $stack['location']['deaths_christian_adherents_next_hour'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next hour',
                        'count' => $stack['location']['deaths_christian_adherents_next_hour'],
                        'group' => 'christian_adherents',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_christian_adherents_next_hour'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['deaths_christian_adherents_next_hour'] . ' people will die without a personal relationship with Jesus in the next hour in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                ];
            }
            else if ( $stack['location']['deaths_christian_adherents_next_100'] > 1) {
                 $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next 100 hours',
                        'count' => $stack['location']['deaths_christian_adherents_next_100'],
                        'group' => 'christian_adherents',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_christian_adherents_next_100'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average,' . $stack['location']['deaths_christian_adherents_next_100'] . ' people will die without a personal relationship with Jesus in the next 100 hours in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                 ];
            }
            else if ( $stack['location']['deaths_christian_adherents_next_week'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next week',
                        'count' => $stack['location']['deaths_christian_adherents_next_week'],
                        'group' => 'christian_adherents',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_christian_adherents_next_week'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['deaths_christian_adherents_next_week'] . ' people will die without a personal relationship with Jesus in the next week in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                ];
            }
            else if ( $stack['location']['deaths_christian_adherents_next_month'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next month',
                        'count' => $stack['location']['deaths_christian_adherents_next_month'],
                        'group' => 'christian_adherents',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_christian_adherents_next_month'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['deaths_christian_adherents_next_month'] . ' people will die without a personal relationship with Jesus in the next month in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                ];
            }
        }

        // births christian adherents
        $name = $names[array_rand( $names )];
        if ( 'christian_adherents' === $stack['location']['favor'] && 'births' === $type ) {
            if ( $stack['location']['births_christian_adherents_last_hour'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next hour',
                        'count' => $stack['location']['births_christian_adherents_last_hour'],
                        'group' => 'christian_adherents',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_christian_adherents_last_hour'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_christian_adherents_last_hour'] . ' babies will be born in the next hour to families who might know about God culturally, but likely have no relationship with Jesus in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', make yourself real to these new families.'
                    ]
                ];
            }
            else if ( $stack['location']['births_christian_adherents_last_100'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next 100 hours',
                        'count' => $stack['location']['births_christian_adherents_last_100'],
                        'group' => 'christian_adherents',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_christian_adherents_last_100'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_christian_adherents_last_100'] . ' babies will be born in the next 100 hours to families who might know about God culturally, but likely have no relationship with Jesus in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', reveal yourself to these new families.'
                    ]
                ];
            }
            else if ( $stack['location']['births_christian_adherents_last_week'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next week',
                        'count' => $stack['location']['births_christian_adherents_last_week'],
                        'group' => 'christian_adherents',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_christian_adherents_last_week'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_christian_adherents_last_week'] . ' babies will be born in the next week to families who might know about God culturally, but likely have no relationship with Jesus in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', reveal yourself to these new families.'
                    ]
                ];
            }
            else if ( $stack['location']['births_christian_adherents_last_month'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next month',
                        'count' => $stack['location']['births_christian_adherents_last_month'],
                        'group' => 'christian_adherents',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_christian_adherents_last_month'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_christian_adherents_last_month'] . ' babies will be born in the next month to families who might know about God culturally, but likely have no relationship with Jesus in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', reveal yourself to these new families.'
                    ]
                ];
            }
        }

        $name = $names[array_rand( $names )];
        if ( 'non_christians' === $stack['location']['favor'] && 'deaths' === $type ) {
            if ( $stack['location']['deaths_non_christians_next_hour'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next hour',
                        'count' => $stack['location']['deaths_non_christians_next_hour'],
                        'group' => 'non_christians',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_non_christians_next_hour'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['deaths_non_christians_next_hour'] . ' people will die without Jesus in the next hour in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                ];
            }
            else if ( $stack['location']['deaths_non_christians_next_100'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next 100 hours',
                        'count' => $stack['location']['deaths_non_christians_next_100'],
                        'group' => 'non_christians',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_non_christians_next_100'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['deaths_non_christians_next_100'] . ' people will die without Jesus in the next 100 hours in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                ];
            }
            else if ( $stack['location']['deaths_non_christians_next_week'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next week',
                        'count' => $stack['location']['deaths_non_christians_next_week'],
                        'group' => 'non_christians',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_non_christians_next_week'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['deaths_non_christians_next_week'] . ' people will die without Jesus in the next week in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                ];
            }
            else if ( $stack['location']['deaths_non_christians_next_month'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next month',
                        'count' => $stack['location']['deaths_non_christians_next_month'],
                        'group' => 'non_christians',
                        'type' => 'deaths',
                        'size' => ( $stack['location']['deaths_non_christians_next_month'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['deaths_non_christians_next_month'] . ' will die without Jesus in the next month in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', send your gospel to these.'
                    ]
                ];
            }
        }

        // births non christians
        $name = $names[array_rand( $names )];
        if ( 'non_christians' === $stack['location']['favor'] && 'births' === $type ) {
            if ( $stack['location']['births_non_christians_last_hour'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next hour',
                        'count' => $stack['location']['births_non_christians_last_hour'],
                        'group' => 'non_christians',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_non_christians_last_hour'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_non_christians_last_hour'] . ' babies will be born in the next hour to families who are far from God in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', reveal yourself to these new families.'
                    ]
                ];
            }
            else if ( $stack['location']['births_non_christians_last_100'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next 100 hours',
                        'count' => $stack['location']['births_non_christians_last_100'],
                        'group' => 'non_christians',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_non_christians_last_100'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_non_christians_last_100'] . ' babies will be born in the next 100 hours to families who are far from God in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', reveal yourself to these new families.'
                    ]
                ];
            }
            else if ( $stack['location']['births_non_christians_last_week'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next week',
                        'count' => $stack['location']['births_non_christians_last_week'],
                        'group' => 'non_christians',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_non_christians_last_week'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_non_christians_last_week'] . ' babies will be born in the next week to families who are far from God in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', reveal yourself to these new families.'
                    ]
                ];
            }
            else if ( $stack['location']['births_non_christians_last_month'] > 1 ) {
                $templates[] = [
                    'type' => 'population_change_icon_block',
                    'data' => [
                        'section_label' => 'Next month',
                        'count' => $stack['location']['births_non_christians_last_month'],
                        'group' => 'non_christians',
                        'type' => 'births',
                        'size' => ( $stack['location']['births_non_christians_last_month'] > 400 ) ? 2 : 3,
                        'section_summary' => 'On average, ' . $stack['location']['births_non_christians_last_month'] . ' babies will be born in the next month to families who are far from God in ' . $stack['location']['full_name'] . '.',
                        'prayer' => $name . ', reveal yourself to these new families.'
                    ]
                ];
            }
            // end demographic birth death section
        }

        $stack['list'] = array_merge( array_slice( $stack['list'], 0, $position ), [ $templates[array_rand( $templates )] ], array_slice( $stack['list'], $position ) );
        return $stack;
    }

    public static function _position_3( &$stack, $position = 6 ) {
        $templates = [];

        // least reached
        if ( ! empty( $stack['least_reached'] ) ) {

            $text_list = PG_Stacker_Text::least_reached_text( $stack );
            $text = $text_list[array_rand( $text_list ) ];

            $templates[] = [
                'type' => 'least_reached_block',
                'data' => [
                    'section_label' => 'Least Reached',
                    'focus_label' => $stack['least_reached']['name'],
                    'image_url' => pg_jp_image( 'pid3', $stack['least_reached']['PeopleID3'] ), // ion icons from /pages/fonts/ionicons/
                    'section_summary' => $text['section_summary'],
                    'prayer' => $text['prayer'],
                    'diaspora_label' => $stack['least_reached']['diaspora_label'],
                ]
            ];
        }

        // people groups
        else if ( ! empty( $stack['people_groups'] ) ) {
            $image_list = pg_jp_images_json();
            $base_url = pg_jp_image_url();

            // people group list
            $values = [];
            foreach ( $stack['people_groups'] as $group ) {
                if ( isset( $image_list['pid3'][$group['PeopleID3']] ) ) {
                    $image = $base_url . 'pid3/' . $image_list['pid3'][$group['PeopleID3']];
                } else {
                    continue;
                }

                $values[$group['PeopleID3']] = [
                    'name' => $group['name'],
                    'image_url' => $image,
                    'description' => $group['name'] . '<br>(' . $group['PrimaryReligion'].')',
                    'progress' => $group['JPScale'],
                    'progress_image_url' => $base_url . 'progress/' . $image_list['progress'][$group['JPScale']],
                    'least_reached' => $group['LeastReached']
                ];
            }
            if ( ! empty( $values ) ) {
                $templates[] = [
                    'type' => 'people_groups_list',
                    'data' => [
                        'section_label' => 'People Groups In The Area',
                        'values' => $values,
                        'section_summary' => '',
                        'prayer' => ''
                    ]
                ];
            }
        }
        else {

            // cities
            if ( ! empty( $stack['cities'] ) ) {

                $cities = $stack['cities'];
                shuffle( $cities );
                if ( isset( $cities[0] ) && ! empty( $cities[0] ) ) {

                    $text_list = PG_Stacker_Text::key_city_text( $stack, $cities[0] );
                    $text = $text_list[array_rand( $text_list ) ];

                    $templates[] = [
                        'type' => 'content_block',
                        'data' => [
                            'section_label' => 'Focus City',
                            'focus_label' => 'Pray for the city of ' . $cities[0]['name'],
                            'icon' => 'ion-map', // ion icons from /pages/fonts/ionicons/
                            'color' => 'secondary',
                            'section_summary' => '',
                            'prayer' => $text['section_summary'],
                        ]
                    ];
                }
            }
        }

        if ( empty( $templates ) ) {
            return $stack;
        } else {
            $stack['list'] = array_merge( array_slice( $stack['list'], 0, $position ), [ $templates[array_rand( $templates )] ], array_slice( $stack['list'], $position ) );
            return $stack;
        }
    }

    public static function _position_4( &$stack, $position = 7 ) {
        $templates = [];

        // @add more

        if ( empty( $templates ) ) {
            return $stack;
        } else {
            $stack['list'] = array_merge( array_slice( $stack['list'], 0, $position ), [ $templates[array_rand( $templates )] ], array_slice( $stack['list'], $position ) );
            return $stack;
        }
    }

    public static function _position_5( &$stack, $position = 9 ) {
        $templates = [];

        // demographics
        $text_list = PG_Stacker_Text::demographics_content_text( $stack );
        $text = $text_list[$stack['location']['favor']][array_rand( $text_list[$stack['location']['favor']] ) ];
        $templates[] = [
            'type' => 'content_block',
            'data' => [
                'section_label' => 'Demographics',
                'focus_label' => $stack['location']['full_name'],
                'icon' => 'ion-map',
                'color' => $stack['location']['icon_color'],
                'section_summary' => $text['section_summary'],
                'prayer' => ''
            ]
        ];

        $text_list = PG_Stacker_Text::demogrphics_4_fact_text( $stack );
        $text = $text_list[$stack['location']['favor']][array_rand( $text_list[$stack['location']['favor']] ) ];
        $templates[] = [
            'type' => '4_fact_blocks',
            'data' => [
                'section_label' => 'Demographics',
                'focus_label' => $stack['location']['full_name'],
                'label_1' => 'Population',
                'value_1' => $stack['location']['population'],
                'size_1' => 'two-em',
                'label_2' => 'Believers',
                'value_2' => $stack['location']['believers'],
                'size_2' => 'two-em',
                'label_3' => 'Dominant Religion',
                'value_3' => $stack['location']['primary_religion'],
                'size_3' => 'two-em',
                'label_4' => 'Language',
                'value_4' => $stack['location']['primary_language'],
                'size_4' => 'two-em',
                'section_summary' => '',
                'prayer' => $text['prayer']
            ]
        ];
        $templates[] = [
            'type' => '4_fact_blocks',
            'data' => [
                'section_label' => 'Demographics',
                'focus_label' => $stack['location']['full_name'],
                'label_1' => 'Non-Christians',
                'value_1' => $stack['location']['non_christians'],
                'size_1' => 'two-em',
                'label_2' => 'Cultural Christians',
                'value_2' => $stack['location']['christian_adherents'],
                'size_2' => 'two-em',
                'label_3' => 'Believers',
                'value_3' => $stack['location']['believers'],
                'size_3' => 'two-em',
                'label_4' => 'Language',
                'value_4' => $stack['location']['primary_language'],
                'size_4' => 'two-em',
                'section_summary' => '',
                'prayer' => $text['prayer']
            ]
        ];

        if ( empty( $templates ) ) {
            return $stack;
        } else {
            $stack['list'] = array_merge( array_slice( $stack['list'], 0, $position ), [ $templates[array_rand( $templates )] ], array_slice( $stack['list'], $position ) );
            return $stack;
        }
    }
}
