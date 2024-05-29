<?php
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

// https://www.missionfrontiers.org/issue/article/the-ten-universal-elements

class PG_Stacker_Text {
    /*********************************************************************
     *
     * V2 TEXT STACK ELEMENTS
     *
     *********************************************************************/

    public static function _for_extraordinary_prayer( &$lists, $stack, $all = false ) {
        $section_label = __( 'Prayer Movement', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, we cry out for a prayer movement in %1$s of %2$s. Please, stir the %3$s believers here to pray for awakening.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'], $stack['location']['believers'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, cause a passion for prayer among the people of %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'John 17:20-21', 'prayer-global-porch' ),
                'verse' => _x( 'I (Jesus) pray also for those who will believe in me through their message, that all of them may be one, Father, just as you are in me and I am in you. May they also be in us so that the world may believe that you have sent me.', 'John 17:20-21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, stir the hearts of your people in %1$s of %2$s to agree with you in prayer.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'John 17:20-21', 'prayer-global-porch' ),
                'verse' => _x( 'I (Jesus) pray also for those who will believe in me through their message, that all of them may be one, Father, just as you are in me and I am in you. May they also be in us so that the world may believe that you have sent me.', 'John 17:20-21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, teach the church in %1$s of %2$s to increase their prayer for your kingdom to come.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Daniel 6:10', 'prayer-global-porch' ),
                'verse' => _x( 'Now when Daniel learned that the decree had been published, he went home to his upstairs room where the windows opened toward Jerusalem. Three times a day he got down on his knees and prayed, giving thanks to his God...', 'Daniel 6:10', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, teach the children in %1$s of %2$s to pray with passion and pleading for your presence.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, awaken a burning desire for your presence and intimacy among the %1$s people living in %2$s of %3$s.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord we pray you unite the %1$s believers to pray at all times in the Spirit, with all prayer and supplication, for spiritual breakthrough in %2$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( 'Philippians 4:6', 'prayer-global-porch' ),
                'verse' => _x( '... in every situation, by prayer and petition, with thanksgiving, present your requests to God.', 'Philippians 4:6', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'God, we pray for the believers in %1$s that they will know how to spend an hour in prayer with you.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Please, teach the %1$s believers in %2$s how to pray to you and how to listen for your voice. That they might follow you into the good works you have prepared for them.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( 'John 10:27', 'prayer-global-porch' ),
                'verse' => _x( 'My sheep listen to my voice; I know them, and they follow me.', 'John 10:27', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, answer the requests of your people in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '1 John 5:14', 'prayer-global-porch' ),
                'verse' => _x( 'This is the boldness which we have toward him, that, if we ask anything according to his will, he listens to us.', '1 John 5:14', 'prayer-global-porch' ),
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
        $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_intentional_movement_strategy( &$lists, $stack, $all = false ) {
        $section_label = __( 'Intentional Multiplicative Strategies', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, you taught Paul to train Timothy to train faithful men who would train others. Please, teach the church of %1$s to do the same.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( '2 Timothy 2:2', 'prayer-global-porch' ),
                'verse' => _x( 'And the things you have heard me say in the presence of many witnesses entrust to reliable people who will also be qualified to teach others.', '2 Timothy 2:2', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, please equip every disciple to make disciples who make disciples in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '2 Timothy 2:2', 'prayer-global-porch' ),
                'verse' => _x( 'And the things you have heard me say in the presence of many witnesses entrust to reliable people who will also be qualified to teach others.', '2 Timothy 2:2', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please, raise up a generation of disciples in %1$s of %2$s who will make disciples who make disciples.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the church in %1$s of %2$s to exponentially multiply disciples.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please make every disciple be a disciple maker, every home a training center, and every church a church planting movement in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the church in %1$s of %2$s do things that will multiply their numbers, not just add to them.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '2 Corinthians 2:14', 'prayer-global-porch' ),
                'verse' => _x( 'But thanks be to God, who always leads us triumphantly as captives in Christ and through us spreads everywhere the fragrance of the knowledge of Him.', '2 Corinthians 2:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, help the church in %1$s of %2$s to not rely on buildings or programs, but on your Spirit and the simple faithfulness of every believer.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, reveal best practices for sharing the gospel in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
        $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_abundant_gospel_sowing( &$lists, $stack, $all = false ) {
        $section_label = __( 'Abundant Gospel Sowing', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, please give new believers a yearning to see you praised in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 96:3', 'prayer-global-porch' ),
                'verse' => _x( 'Declare his glory among the nations, his marvelous deeds among all peoples.', 'Psalm 96:3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, give the disciples of the %1$s of %2$s words, actions, signs and wonders to proclaim the coming of the Kingdom.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 10:7', 'prayer-global-porch' ),
                'verse' => _x( 'As you go, proclaim this message: "The kingdom of heaven has come near."', 'Matthew 10:7', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, make the %1$s believers in %2$s to be brave and clear with the gospel to their %3$s neighbors.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'], $stack['location']['all_lost'] ),
                'reference' => __( 'Acts 14:3', 'prayer-global-porch' ),
                'verse' => _x( 'So Paul and Barnabas spent considerable time there, speaking boldly for the Lord, who confirmed the message of his grace by enabling them to perform signs and wonders.', 'Acts 14:3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, we pray the believers are good spiritual stewards of their everyday relationships in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, all authority was given to you, and you commanded all disciples in %1$s to make more disciples, and you promised to be with them. May your power and their obedience make more disciples today.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 28:18', 'prayer-global-porch' ),
                'verse' => _x( 'All authority in heaven and on earth has been given to me. Therefore go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit, and teaching them to obey everything I have commanded you. And surely I am with you always, to the very end of the age.', 'Matthew 28:18', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, help the %1$s believers in %2$s to be spiritually intentional with their relationships among their %3$s lost friends and neighbors.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'], $stack['location']['all_lost'] ),
                'reference' => '',
                'verse' => '',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_persons_of_peace( &$lists, $stack, $all = false ) {
        $section_label = __( 'Person of Peace', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the %1$s believers find a person of peace today among the %2$s lost neighbors around them. And help them start discovery bible studies in these unbelieving homes.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['all_lost'] ),
                'reference' => __( 'Acts 10:30-33', 'prayer-global-porch' ),
                'verse' => _x( 'Suddenly a man in shining clothes stood before me and said, ‘Cornelius, God has heard your prayer and remembered your gifts to the poor. Send to Joppa for Simon who is called Peter. He is a guest in the home of Simon the tanner, who lives by the sea.’ So I sent for you immediately, and it was good of you to come. Now we are all here in the presence of God to listen to everything the Lord has commanded you to tell us.”', 'Acts 10:30-33', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, help your children in %1$s find someone like the Samaritan Woman today. Someone who will open an entire town to your message of salvation.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'John 4:1–30', 'prayer-global-porch' ),
                'verse' => _x( 'So the woman left her water jar and went away into town and said to the people, 29 “Come, see a man who told me all that I ever did. Can this be the Christ?” They went out of the town and were coming to him.', 'John 4:1–30', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, like with the Ethiopian Eunuch, set up a meeting today between a faithful believer in %1$s and a person seeking to understand the truth.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Acts 8:26–40', 'prayer-global-porch' ),
                'verse' => _x( 'And the eunuch said to Philip, “About whom, I ask you, does the prophet say this, about himself or about someone else?” Then Philip opened his mouth, and beginning with this Scripture he told him the good news about Jesus.', 'Acts 8:26–40', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, reveal yourself to a faithful non-believer today, someone like Cornelius, and then Father please connect him with the church in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Acts 10:9–11:1', 'prayer-global-porch' ),
                'verse' => _x( 'And Cornelius said, “Four days ago, about this hour, I was praying in my house ... and behold, a man stood before me in bright clothing and said, "Cornelius, your prayer has been heard and your alms have been remembered before God."', 'Acts 10:9–11:1', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, guide someone in the church in %1$s of %2$s to a person ready to receive the message of the gospel, like Lydia, and who will then open her home to faith.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Acts 16:13–15', 'prayer-global-porch' ),
                'verse' => _x( 'One of those listening was a woman from the city of Thyatira named Lydia, a dealer in purple cloth. She was a worshiper of God. The Lord opened her heart to respond to Paul’s message.', 'Acts 16:13–15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the disciples in %1$s of %2$s to find a person of peace today, like the Philippian jailer, who heard and was immediately baptized with his whole family.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Acts 16:32–33', 'prayer-global-porch' ),
                'verse' => _x( 'And they spoke the word of the Lord to him and to all who were in his house. And he took them the same hour of the night and washed their wounds; and he was baptized at once, he and all his family.', 'Acts 16:32–33', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, like with the centurion who came to you for his sick servant, please call into your house those who have great faith but are not yet yours in %1$s of %2$s', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Luke 7:9–10', 'prayer-global-porch' ),
                'verse' => _x( 'When Jesus heard these things, he marveled at him, and turning to the crowd that followed him, said, “I tell you, not even in Israel have I found such faith.” And when those who had been sent returned to the house, they found the servant well.', 'Luke 7:9–10', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_prioritizing_priesthood_of_believers( &$lists, $stack, $all = false ) {
        $section_label = __( 'Priesthood of Believers', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, guide the church in %1$s to see their community as a holy priesthood, offering spiritual sacrifices acceptable to God.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( '1 Peter 2:4-5', 'prayer-global-porch' ),
                'verse' => _x( 'you also, like living stones, are being built into a spiritual house to be a holy priesthood, offering spiritual sacrifices acceptable to God through Jesus Christ.', '1 Peter 2:4-5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, thank you that in your kindness you have made every believer in %1$s a priest, who can offer spiritual sacrifices to you through Jesus.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 21:43-44', 'prayer-global-porch' ),
                'verse' => _x( 'Therefore I tell you that the kingdom of God will be taken away from you and given to a people who will produce its fruit. He who falls on this stone will be broken to pieces, but he on whom it falls will be crushed.”', 'Matthew 21:43-44', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, please convict each believer in %1$s to take up their calling as a priesthood of believers and pray for the %2$s lost around them.', 'prayer-global-porch' ), $stack['location']['full_name'], $stack['location']['all_lost'] ),
                'reference' => __( '1 Peter 2:4-5', 'prayer-global-porch' ),
                'verse' => _x( 'you also, like living stones, are being built into a spiritual house to be a holy priesthood', '1 Peter 2:4-5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please raise up every one you have called in %1$s to become worthy of their calling, and offer spiritual sacrifices acceptable to you through Jesus.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 4:1', 'prayer-global-porch' ),
                'verse' => _x( 'I urge you to live a life worthy of the calling you have received', 'Ephesians 4:1', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, please convict the believers in %1$s to not assume the ministry is for professional clergy, but for all who have been called by you.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, encourage the %1$s believers to have boldness before you, since they have a great high priest who has passed through the heavens, Jesus the Son of God.', 'prayer-global-porch' ), $stack['location']['believers'] ),
                'reference' => __( 'Hebrews 4:14-16', 'prayer-global-porch' ),
                'verse' => _x( 'Since then we have a great high priest who has passed through the heavens, Jesus, the Son of God, let us hold fast our confession.', 'Hebrews 4:14-16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, you are the great high priest, please make the %1$s believers in %2$s a worthy priesthood under you.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( 'Hebrews 4:14-16', 'prayer-global-porch' ),
                'verse' => _x( 'Since then we have a great high priest who has passed through the heavens, Jesus, the Son of God, let us hold fast our confession.', 'Hebrews 4:14-16', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_unleashing_simple_churches( &$lists, $stack, $all = false ) {
        $section_label = __( 'Unleashing Simple Churches', 'prayer-global-porch' );
        $the_church_section_label = __( 'The Church', 'prayer-global-porch' );
        $church_planting_section_label = __( 'Church Planting', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'God, guide the %1$s believers in %2$s to multiply spiritual families that love you, love each other, and make disciples.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the %1$s believers in %2$s to start simple multiplying churches in their homes.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, we pray that the %1$s of %2$s be filled with simple churches in every neighborhood.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Isaiah 11:9', 'prayer-global-porch' ),
                'verse' => _x( 'For the earth will be full of the knowledge of the Lord, as the waters cover the sea.', 'Isaiah 11:9', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, we ask for %1$s new simple churches in %2$s of %3$s. Place a simple church in every community of the %4$s people living here.', 'prayer-global-porch' ), $stack['location']['new_churches_needed'], $stack['location']['admin_level_title'], $stack['location']['full_name'], $stack['location']['population'] ),
                'reference' => __( 'Psalm 72:19', 'prayer-global-porch' ),
                'verse' => _x( 'And blessed be His glorious name forever; And may the whole earth be filled with His glory. Amen, and Amen.', 'Psalm 72:19', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, teach the %1$s believers in %2$s of %3$s the wisdom of how to form simple, reproducible churches of 12-30 in every neighborhood.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, bless the %1$s of %2$s with a multiplying movement of house churches.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Numbers 14:21', 'prayer-global-porch' ),
                'verse' => _x( '...but indeed, as I live, all the earth will be filled with the glory of the Lord.', 'Numbers 14:21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'God, we pray both the men and women of %1$s will find ways to meet in groups of two or three to encourage and correct one another from your Word.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $the_church_section_label,
                'prayer' => sprintf( __( 'Father, multiply brothers, sisters, and mothers to our spiritual family in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 12:50', 'prayer-global-porch' ),
                'verse' => _x( 'He replied to him, “Who is my mother, and who are my brothers?” Pointing to his disciples, he said, “Here are my mother and my brothers. For whoever does the will of my Father in heaven is my brother and sister and mother.”', 'Matthew 12:50', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $the_church_section_label,
                'prayer' => sprintf( __( 'Father, we rejoice that you who began a good work in the church of %1$s will carry it on to completion until the day of Jesus Christ!', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Philippians 1:6', 'prayer-global-porch' ),
                'verse' => _x( '...being confident of this, that he who began a good work in you will carry it on to completion until the day of Christ Jesus.', 'Philippians 1:6', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $the_church_section_label,
                'prayer' => sprintf( __( 'Father, remind your church in %1$s that you have set your Son over all rule and authority, power and dominion, and every name that is invoked.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 1:21', 'prayer-global-porch' ),
                'verse' => _x( '...he raised Christ from the dead and seated him at his right hand in the heavenly realms, far above all rule and authority, power and dominion, and every name that is invoked, not only in the present age but also in the one to come.', 'Ephesians 1:21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Father, help %1$s new simple churches start among the %2$s people in the %3$s of %4$s. One within reach of everyone living here.', 'prayer-global-porch' ), $stack['location']['new_churches_needed'], $stack['location']['population'], $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Habakkuk 2:14', 'prayer-global-porch' ),
                'verse' => _x( 'For the earth will be filled with the knowledge of the glory of the Lord as the waters cover the sea.', 'Habakkuk 2:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Spirit, please start new house churches in every neighborhood of the %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Habakkuk 2:14', 'prayer-global-porch' ),
                'verse' => _x( 'For the earth will be filled with the knowledge of the glory of the Lord as the waters cover the sea.', 'Habakkuk 2:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Spirit, please give every church in %1$s of %2$s a passion to plant another simple church.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Father, show your mercy on the %1$s people in %2$s who are far from you. Please add %3$s new house churches this year.', 'prayer-global-porch' ), $stack['location']['all_lost'], $stack['location']['name'], $stack['location']['new_churches_needed'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Father, we agree with your desire that the people in %1$s of %2$s hear about you.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Romans 15:21', 'prayer-global-porch' ),
                'verse' => _x( 'Those who were not told about him will see, and those who have not heard will understand.', 'Romans 15:21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Father, let every disciple be a disciple maker, every home a training center, and every church a church planting movement in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Father, we ask for networks of simple churches in every city in %1$s of %2$s, like Paul planted in Corinth and Ephesus.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '1 Corinthians 16:19', 'prayer-global-porch' ),
                'verse' => _x( 'The churches in the province of Asia send you greetings. Aquila and Priscilla greet you warmly in the Lord, and so does the church that meets at their house.', '1 Corinthians 16:19', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $church_planting_section_label,
                'prayer' => sprintf( __( 'Jesus, %1$s people live in %2$s of %3$s. Please, give them %4$s new simple churches this year.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['admin_level_title'], $stack['location']['name'], $stack['location']['new_churches_needed'] ),
                'reference' => '',
                'verse' => '',
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_bible_access( &$lists, $stack, $all = false ) {
        $section_label = __( 'Bible Access', 'prayer-global-porch' );
        $templates = [];

        // focus for non christians is exposure to the Word of God and access to a bible
        $templates['non_christians'] = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please give the people in %1$s of %2$s access to a Bible in their own language.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, how will they hear without a preacher? How will they preach unless they have a Bible? Please give the people in %1$s of %2$s access to a Bible in their own language.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Romans 10:14-15', 'prayer-global-porch' ),
                'verse' => _x( 'How, then, can they call on the one they have not believed in? And how can they believe in the one of whom they have not heard? And how can they hear without someone preaching to them? And how can anyone preach unless they are sent? As it is written: “How beautiful are the feet of those who bring good news!”', 'Romans 10:14-15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please remove the barriers that keep the %1$s who are far from you in %2$s from having access to a Bible.', 'prayer-global-porch' ), $stack['location']['non_christians'], $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 24:14', 'prayer-global-porch' ),
                'verse' => _x( 'And this gospel of the kingdom will be preached in the whole world as a testimony to all nations, and then the end will come.', 'Matthew 24:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, put your Bible in the hands of the %1$s, who are far from you and live in this place.', 'prayer-global-porch' ), $stack['location']['non_christians'] ),
                'reference' => __( 'Psalm 119:9-10', 'prayer-global-porch' ),
                'verse' => _x( 'How can a young person stay on the path of purity? By living according to your Word. I seek you with all my heart; do not let me stray from your commands.', 'Psalm 119:9-10', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, it’s possible most of the %1$s lost people in  %2$s have never held or opened a Bible. Please change this, Father.', 'prayer-global-porch' ), $stack['location']['non_christians'], $stack['location']['full_name'] ),
                'reference' => __( 'Romans 10:17', 'prayer-global-porch' ),
                'verse' => _x( 'Yet faith comes from listening to this Good News—the Good News about Christ.', 'Romans 10:17', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        // Focus on christian adherents is re engagement with the Bible directly, not through traditions or church leaders.
        $templates['christian_adherents'] = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, there are %1$s people in %2$s of %3$s who claim Christianity, but may have never read the Bible. Please challenge them today to read the Bible for themselves.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '2 Timothy 3:16-17', 'prayer-global-porch' ),
                'verse' => _x( 'All scripture is given by inspiration of God, and is profitable for doctrine, for reproof, for correction, for instruction in righteousness.', '2 Timothy 3:16-17', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, of the %1$s people in %2$s of %3$s who claim Christianity, challenge some of them to pick up your Word and read it for themselves today.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'John 8:32', 'prayer-global-porch' ),
                'verse' => _x( 'and you will know the truth, and the truth will set you free.', 'John 8:32', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, your Word is essential for life and growth. Please challenge the %1$s cultural Christians in %2$s of %3$s to read your Word for themselves today.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 4:4', 'prayer-global-porch' ),
                'verse' => _x( 'Man shall not live by bread alone, but by every word that comes from the mouth of God.', 'Matthew 4:4', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, the %1$s of %2$s will disappear one day, but your Word will never disappear. Call all who claim Christianity to anchor their lives on your Word.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 24:35', 'prayer-global-porch' ),
                'verse' => _x( 'Heaven and earth will disappear, but my words will never disappear.', 'Matthew 24:35', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, your Word can be a lamp to the feet of the %1$s people in %2$s of %3$s who claim to know you, if they open it and read it today.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:105', 'prayer-global-porch' ),
                'verse' => _x( 'your Word is a lamp to my feet and a light to my path.', 'Psalm 119:105', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, make the %1$s people in %2$s of %3$s who claim to know you, brave enough to let the Bible weigh their thoughts and intentions today.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Hebrews 4:12', 'prayer-global-porch' ),
                'verse' => _x( 'For the word of God is living and powerful, and sharper than any two-edged sword, piercing even to the division of soul and spirit, and of joints and marrow, and is a discerner of the thoughts and intents of the heart.', 'Hebrews 4:12', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help get online Bibles and Bible apps onto the phones of the %1$s people who claim to know you, so they can read everyday.', 'prayer-global-porch' ), $stack['location']['christian_adherents'] ),
                'reference' => '',
                'verse' => '',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        // Focus for believers is engagement with the Bible, faithfulness to the Word.
        $templates['believers'] = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please provide access to your Word for everyone, especially believers in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 24:14', 'prayer-global-porch' ),
                'verse' => _x( 'And this gospel of the kingdom will be preached in the whole world as a testimony to all nations, and then the end will come.', 'Matthew 24:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, if there is even one of the %1$s believers in %2$s who does not have a Bible, please provide them one today.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, let your Word be a lamp to the feet of the %1$s believers in %2$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 119:105', 'prayer-global-porch' ),
                'verse' => _x( 'your Word is a lamp to my feet and a light to my path.', 'Psalm 119:105', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the %1$s believers in %2$s desire the Bible as newborn babies desire milk.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( '1 Peter 2:2-3', 'prayer-global-porch' ),
                'verse' => _x( 'Desire God’s pure word as newborn babies desire milk. Then you will grow in your salvation.', '1 Peter 2:2-3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, provide a good translation of the Bible for the %1$s believers in %2$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, provide a Bible for every believer in %1$s, and teach them to obey it.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'James 1:23-25', 'prayer-global-porch' ),
                'verse' => _x( 'For if you listen to the word and don’t obey, it is like glancing at your face in a mirror. 24 you see yourself, walk away, and forget what you look like. 25 But if you look carefully into the perfect law that sets you free, and if you do what it says and don’t forget what you heard, then God will bless you for doing it.', 'James 1:23-25', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, inspire Bible translators to communicate the Scriptures accurately in the heart languages spoken in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];


        if ( $all ) {
            $combined_templates = [];
            foreach ( $templates as $template ) {
                $combined_templates = array_merge( $combined_templates, $template );
            }
            return array_merge( $combined_templates, $lists );
        }
        $templates = $templates[$stack['location']['favor']];
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_internet_gospel_access( &$lists, $stack, $all = false ) {
        $section_label = __( 'Media', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please help good, online teachers get the gospel on YouTube and into the %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 24:14', 'prayer-global-porch' ),
                'verse' => _x( 'And this gospel of the kingdom will be preached in the whole world as a testimony to all nations, and then the end will come.', 'Matthew 24:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, guide seekers in %1$s to the gospel through searching YouTube or TikTok today.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Proverbs 8:17', 'prayer-global-porch' ),
                'verse' => _x( 'I love those who love me, and those who diligently seek me will find me.', 'Proverbs 8:17', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, help media producers communicate the gospel in a way that is understandable to the people of %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Deuteronomy 4:29', 'prayer-global-porch' ),
                'verse' => _x( 'But from there, you will seek the LORD your God, and you will find Him if you search for Him with all your heart and all your soul.', 'Deuteronomy 4:29', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, as people seek answers on the internet, please help them find the gospel in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Luke 11:9-10', 'prayer-global-porch' ),
                'verse' => _x( 'So I say to you, ask, and it will be given to you; seek, and you will find; knock, and it will be opened to you.', 'Luke 11:9-10', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, guide every search on Google for truth in %1$s to find a gospel video.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Jeremiah 29:13', 'prayer-global-porch' ),
                'verse' => _x( 'you will seek Me and find Me when you search for Me with all your heart.', 'Jeremiah 29:13', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, use Google search to lead people in %1$s to the gospel today.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, supernaturally prepare encounters with the gospel on sites like Facebook and Instagram for the %1$s people living in %2$s.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, inspire new kinds of evangelism through social media in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( '2 Timothy 4:5', 'prayer-global-porch' ),
                'verse' => _x( 'But you, keep your head in all situations, endure hardship, do the work of an evangelist, discharge all the duties of your ministry.', '2 Timothy 4:5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, make yourself known to the %1$s people living in %2$s through the internet today.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 19:4', 'prayer-global-porch' ),
                'verse' => _x( 'They have no speech, they use no words; no sound is heard from them. Yet their voice goes out into all the earth, their words to the ends of the world. In the heavens God has pitched a tent for the sun.', 'Psalm 19:4', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_safety( &$lists, $stack, $all = false ) {
        $section_label = __( 'Safety', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, for those in trouble in %1$s of %2$s prompt them to call on you for rescue today.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 91:15', 'prayer-global-porch' ),
                'verse' => _x( 'He will call on me, and I will answer him. I will be with him in trouble. I will deliver him, and honor him.', 'Psalm 91:15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, for those with enemies and who are afraid in %1$s, call them into your shelter and safety today.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Psalm 61:3', 'prayer-global-porch' ),
                'verse' => _x( 'For you have been a refuge for me, a strong tower from the enemy.', 'Psalm 61:3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, be a refuge and strength for the hurting in %1$s today.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 46:1', 'prayer-global-porch' ),
                'verse' => _x( 'God is our refuge and strength, an ever-present help in trouble.', 'Psalm 46:1', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, help the stressed and anxious in %1$s know that you care for them today.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 55:22', 'prayer-global-porch' ),
                'verse' => _x( 'Cast your cares on the Lord and he will sustain you; he will never let the righteous be shaken.', 'Psalm 55:22', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, teach those feeling unsafe in %1$s that they can hide under your wings', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 91:4', 'prayer-global-porch' ),
                'verse' => _x( 'He will cover you with his feathers, and under his wings you will find refuge; his faithfulness will be your shield and rampart.', 'Psalm 91:4', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, protect the vulnerable in %1$s from the evil one.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'John 17:15', 'prayer-global-porch' ),
                'verse' => _x( 'My prayer is not that you take them out of the world but that you protect them from the evil one.', 'John 17:15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, let the threatened of %1$s know that it is better to trust in you than to trust in humans.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 118:8', 'prayer-global-porch' ),
                'verse' => _x( 'It is better to take refuge in the Lord than to trust in humans.', 'Psalm 118:8', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the fearful in %1$s to submit to God and resist the devil.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'James 4:7', 'prayer-global-porch' ),
                'verse' => _x( 'Submit yourselves, then, to God. Resist the devil, and he will flee from you.', 'James 4:7', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, encourage those who are afraid in %1$s that you are the healer and you are the Savior.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Jeremiah 17:14', 'prayer-global-porch' ),
                'verse' => _x( 'Heal me, Lord, and I will be healed; save me and I will be saved, for you are the one I praise.', 'Jeremiah 17:14', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Psalm 145:18-20', 'prayer-global-porch' ),
//                'verse' => _x( 'The Lord is near to all who call on him, to all who call on him in truth. He fulfills the desires of those who fear him; he hears their cry and saves them.', 'Psalm 145:18-20', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Psalms 107:13-14', 'prayer-global-porch' ),
//                'verse' => _x( 'Then they cried to the Lord in their trouble, and he saved them from their distress. He brought them out of darkness, the utter darkness, and broke away their chains.', 'Psalms 107:13-14', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Psalm 34:10', 'prayer-global-porch' ),
//                'verse' => _x( 'The lions may grow weak and hungry, but those who seek the Lord lack no good thing.', 'Psalm 34:10', 'prayer-global-porch' ),
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_political_stability( &$lists, $stack, $all = false ) {
        $section_label = __( 'Political Stability', 'prayer-global-porch' );
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Proverbs 28:5', 'prayer-global-porch' ),
//                'verse' => _x( 'Evil men do not understand justice, But those who seek the LORD understand all things.', 'Proverbs 28:5', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Proverbs 2:3-6', 'prayer-global-porch' ),
//                'verse' => _x( 'Indeed, if you call out for insight and cry aloud for understanding, and if you look for it as for silver and search for it as for hidden treasure, then you will understand the fear of the Lord and find the knowledge of God. For the Lord gives wisdom; from his mouth come knowledge and understanding.', 'Proverbs 2:3-6', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_demographic_feature_total_population( &$lists, $stack, $all = false ) {
        $section_label = __( 'Population', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => __( 'Far from God', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Father, you desire the people in %1$s of %2$s who are far from you to hear about you.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Romans 15:21', 'prayer-global-porch' ),
                'verse' => _x( 'Those who were not told about him will see, and those who have not heard will understand.', 'Romans 15:21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'There are %1$s people living in %2$s of %3$s. Only about %4$s might be believers.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['admin_level_title'], $stack['location']['name'], $stack['location']['believers'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'The %1$s of %2$s has (about) %3$s people who know Jesus, %4$s people who know about him culturally, and %5$s people who are far from Jesus.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'], $stack['location']['believers'], $stack['location']['christian_adherents'], $stack['location']['non_christians'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Pour your Spirit out on the %1$s citizens of %2$s, so that they might know your name and the name of your Son.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['full_name'] ),
                'reference' => __( 'Joel 2:28', 'prayer-global-porch' ),
                'verse' => _x( 'And afterward, I will pour out my Spirit on all people. your sons and daughters will prophesy, your old men will dream dreams, your young men will see visions.', 'Joel 2:28', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, we suspect there is 1 believer for every %1$s neighbors who are far from you in %2$s. Please, give courage and opportunity to your children to speak boldly.', 'prayer-global-porch' ), $stack['location']['lost_per_believer'], $stack['location']['name'] ),
                'reference' => __( 'Ephesians 6:19', 'prayer-global-porch' ),
                'verse' => _x( 'Pray also for me, that whenever I speak, words may be given me so that I will fearlessly make known the mystery of the gospel.', 'Ephesians 6:19', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, help the people of %1$s to discover the essence of being a disciple, making disciples, and how to plant churches that multiply.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, you know every soul, and you know who are yours and who are yet to be yours out of the %1$s people living in %2$s. Please, call your lost sheep to yourself.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['full_name'] ),
                'reference' => __( 'Ezekiel 36:24', 'prayer-global-porch' ),
                'verse' => _x( 'For I will take you out of the nations; I will gather you from all the countries and bring you back into your own land.', 'Ezekiel 36:24', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, bring yourself glory in %1$s. Through your servants plant %2$s new churches that love you, love one another, and make disciples this year.', 'prayer-global-porch' ), $stack['location']['name'], $stack['location']['new_churches_needed'] ),
                'reference' => __( 'Habakkuk 2:14', 'prayer-global-porch' ),
                'verse' => _x( 'For the earth will be filled with the knowledge of the glory of the LORD as the waters cover the sea.', 'Habakkuk 2:14', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_demographic_feature_population_non_christians( &$lists, $stack, $all = false ) {
        $section_label = __( 'Non-Christians', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Over %1$s percent of the people of %2$s are far from Jesus. Lord, please send your gospel to them through the internet or radio or television today!', 'prayer-global-porch' ), $stack['location']['percent_non_christians'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Over %1$s percent of the people of %2$s are far from Jesus.', 'prayer-global-porch' ), $stack['location']['percent_non_christians'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, call those who are far off in %1$s, so that they and their family can receive life.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Acts 2:39', 'prayer-global-porch' ),
                'verse' => _x( 'For the promise is to you, and to your children, and to all who are far off, even as many as the Lord our God will call to himself.', 'Acts 2:39', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, you said, "The earth belongs to Me and all that is in it". Please, call %1$s into obedience and eternal life.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 24:1', 'prayer-global-porch' ),
                'verse' => _x( 'The earth is Yahweh’s, with its fullness; the world, and those who dwell therein.', 'Psalm 24:1', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, let it be said of the %1$s lost in %2$s that you have called them out of darkness into your glorious light.', 'prayer-global-porch' ), $stack['location']['all_lost'], $stack['location']['name'] ),
                'reference' => __( '1 Peter 2:9', 'prayer-global-porch' ),
                'verse' => _x( 'But you are a chosen race, a royal priesthood, a holy nation, a people for God’s own possession, that you may proclaim the excellence of him who called you out of darkness into his marvelous light', '1 Peter 2:9', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, please make the same Spirit that raised Jesus from the dead give life to those who are called by his name in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Romans 8:11', 'prayer-global-porch' ),
                'verse' => _x( 'But if the Spirit of him who raised up Jesus from the dead dwells in you, he who raised up Christ Jesus from the dead will also give life to your mortal bodies through his Spirit who dwells in you.', 'Romans 8:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, you desire to blot out the sins of the people of %1$s. You said, if they turn to you, you will dissolve their sins like mist.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Isaiah 44:22', 'prayer-global-porch' ),
                'verse' => _x( 'I have blotted out, as a thick cloud, your transgressions, and, as a cloud, your sins. Return to me, for I have redeemed you.', 'Isaiah 44:22', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, please send your Spirit to %1$s, so they can have freedom.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( '2 Corinthians 3:17', 'prayer-global-porch' ),
                'verse' => _x( 'Now the Lord is the Spirit and where the Spirit of the Lord is, there is freedom.', '2 Corinthians 3:17', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_demographic_feature_population_christian_adherents( &$lists, $stack, $all = false ) {
        $section_label = __( 'Cultural Christians', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, %1$s cultural Christians in %2$s likely have a Bible in their home. Please, send conviction for them to open it and read it for themselves.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, teach the %1$s cultural Christians in %2$s to pray from the heart and not with scripts or formulas only.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, bless the %1$s cultural Christians in %2$s with more knowledge and curiosity about your beautiful gospel, that they might claim it for themselves personally and intimately.', 'prayer-global-porch' ), $stack['location']['christian_adherents'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_demographic_feature_population_believers( &$lists, $stack, $all = false ) {
        $section_label = __( 'Believer Families', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, thank you for the %1$s whom you have brought close through the blood of Christ already in %2$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 2:13', 'prayer-global-porch' ),
                'verse' => _x( 'But now in Christ Jesus you who once were far off are made near in the blood of Christ.', 'Ephesians 2:13', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, thank you for the %1$s people that you have made believe and given eternal life to in %2$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( 'John 3:16', 'prayer-global-porch' ),
                'verse' => _x( 'For God so loved the world, that he gave his only Son, that whoever believes in him should not perish but have eternal life.', 'John 3:16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, you made each of the %1$s believers in %2$s your ambassadors and your primary strategy for reconciling this %3$s .', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'], $stack['location']['admin_level_title'] ),
                'reference' => __( '2 Corinthians 5:20', 'prayer-global-porch' ),
                'verse' => _x( 'We are therefore Christ’s ambassadors, as though God were making his appeal through us. We implore you on Christ’s behalf: Be reconciled to God.', '2 Corinthians 5:20', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( '2 Chronicles 16:9', 'prayer-global-porch' ),
//                'verse' => _x( 'For the eyes of the LORD range throughout the earth to strengthen those whose hearts are fully committed to him.', '2 Chronicles 16:9', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( '1 Chronicles 16:11', 'prayer-global-porch' ),
//                'verse' => _x( 'Seek the LORD and His strength; Seek His face continually.', '1 Chronicles 16:11', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Psalm 105:3-4', 'prayer-global-porch' ),
//                'verse' => _x( 'Glory in his holy name; let the hearts of those who seek the Lord rejoice. Look to the Lord and his strength; seek his face always.', 'Psalm 105:3-4', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( '1 Chronicles 16:1-11', 'prayer-global-porch' ),
//                'verse' => _x( 'Let the heart of those who seek the Lord be glad. Seek the Lord and his strength; seek his presence continually.', '1 Chronicles 16:1-11', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Psalm 34:5', 'prayer-global-porch' ),
//                'verse' => _x( 'Those who look to him are radiant; their faces are never covered with shame.', 'Psalm 34:5', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( '2 Timothy 2:15', 'prayer-global-porch' ),
//                'verse' => _x( 'Do your best to present yourself to God as one approved, a worker who does not need to be ashamed and who correctly handles the word of truth.', '2 Timothy 2:15', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_demographic_feature_primary_religion( &$lists, $stack, $all = false ) { // @todo the primary religion is too general for the specific states and counties
        if ( 'Christianity' === $stack['location']['primary_religion'] ) {
            return $lists;
        }

        $section_label = __( 'Primary Religion', 'prayer-global-porch' );
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'The primary religion in %1$s of %2$s is %3$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'], $stack['location']['primary_religion'] ),
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Father, give the %1$s believers in %2$s of %3$s the skill to communicate your gospel to those who follow %4$s around them.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'], $stack['location']['primary_religion'] ),
//                'reference' => __( 'Ephesians 6:19', 'prayer-global-porch' ),
//                'verse' => _x( 'Pray also for me, that whenever I speak, words may be given me so that I will fearlessly make known the mystery of the gospel.', 'Ephesians 6:19', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Father, many people in %1$s follow %2$s. Please give them accurate knowledge of Jesus.', 'prayer-global-porch' ), $stack['location']['full_name'], $stack['location']['primary_religion'] ),
//                'reference' => __( 'Romans 10:2', 'prayer-global-porch' ),
//                'verse' => _x( 'For I can testify about them that they are zealous for God, but their zeal is not based on knowledge.', 'Romans 10:2', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Lord, increase spiritual dissatisfaction among those in %1$s of %2$s who follow %3$s', so that they would begin to seek you.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'], $stack['location']['primary_religion'] ),
//                'reference' => __( 'Romans 10:2', 'prayer-global-porch' ),
//                'verse' => _x( 'For I can testify about them that they are zealous for God, but their zeal is not based on knowledge.', 'Romans 10:2', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Even though the primary religion is %1$s' in %2$s, Lord, call to yourself persons of peace among the community...those who fear you with the best knowledge they have.', 'prayer-global-porch' ), $stack['location']['primary_religion'] , $stack['location']['name'] ),
//                'reference' => __( 'Acts 10:1,2', 'prayer-global-porch' ),
//                'verse' => _x( 'At Caesarea there was a man named Cornelius, a centurion in what was known as the Italian Regiment. He and all his family were devout and God-fearing; he gave generously to those in need and prayed to God regularly.', 'Acts 10:1,2', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_demographic_feature_primary_language( &$lists, $stack, $all = false ) { // @todo the primary religion is too general for the specific states and counties
        if ( 'English' === $stack['location']['primary_language'] ) {
            return $lists;
        }

        $section_label = __( 'Language', 'prayer-global-porch' );
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Father, please provide access to your written Word in the %1$s language.', 'prayer-global-porch' ), $stack['location']['primary_language'] ),
//                'reference' => __( 'Isaiah 55:11', 'prayer-global-porch' ),
//                'verse' => _x( 'So will My word be which goes forth from My mouth; It will not return to Me empty, Without accomplishing what I desire, And without succeeding in the matter for which I sent it.', 'Isaiah 55:11', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Father, please send those who can create videos and podcasts for the %1$s language for the %2$s of %3$s.', 'prayer-global-porch' ), $stack['location']['primary_language'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Father, please provide digital and printed Bibles in %1$s of %2$s specifically in the %3$s language. Give success to those who distribute them.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'], $stack['location']['primary_language'] ),
//                'reference' => __( 'Isaiah 55:11', 'prayer-global-porch' ),
//                'verse' => _x( 'So will My word be which goes forth from My mouth; It will not return to Me empty, Without accomplishing what I desire, And without succeeding in the matter for which I sent it.', 'Isaiah 55:11', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Father, please provide a translation of the Bible in the %1$s language to every seeker in %2$s of %3$s.', 'prayer-global-porch' ), $stack['location']['primary_language'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Spirit, please, send the truth about Jesus through youTube, Tiktok, and Instagram in the %1$s language for the %2$s of %3$s.', 'prayer-global-porch' ), $stack['location']['primary_language'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => sprintf( __( 'Lord, raise up workers in the %1$s language, who can communicate accurately the Word of truth.', 'prayer-global-porch' ), $stack['location']['primary_language'] ),
//                'reference' => __( '2 Timothy 2:15', 'prayer-global-porch' ),
//                'verse' => _x( '...a worker who does not need to be ashamed and who correctly handles the word of truth.', '2 Timothy 2:15', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }




    public static function _for_people_groups_by_least_reached_status( &$lists, $stack, $all = false ) {
        $section_label = __( 'Prayer Movement', 'prayer-global-porch' );
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_people_groups_by_reached_status( &$lists, $stack, $all = false ) {
        $section_label = __( 'Prayer Movement', 'prayer-global-porch' );
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_people_groups_by_religion( &$lists, $stack, $all = false ) {
        $section_label = __( 'Prayer Movement', 'prayer-global-porch' );
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_people_groups_by_population( &$lists, $stack, $all = false ) {
        $section_label = __( 'People Groups', 'prayer-global-porch' );
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_local_leadership( &$lists, $stack, $all = false ) { // local leadership and lay leadership
        $section_label = __( 'Local Leadership', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, build the strength and maturity of the local leaders in %1$s. Show them that faithfulness is better than knowledge. Show them that the Spirit, the Word, and prayer is enough in order to grow and lead.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'God, we ask you to raise up elders and deacons from the %1$s believers in %2$s, who will serve the church and equip it to do your work.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up until we all reach unity in the faith and in the knowledge of the Son of God and become mature, attaining to the whole measure of the fullness of Christ.', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => __( 'Movement Leadership', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Father, we pray for every movement leader and disciple in %1$s of %2$s that they would have deepening intimacy with you.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'John 14:20', 'prayer-global-porch' ),
                'verse' => _x( 'On that day you will realize that I am in my Father, and you are in me, and I am in you.', 'John 14:20', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, grace the churches in %1$s with faithful local leaders.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Proverbs 11:14', 'prayer-global-porch' ),
                'verse' => _x( 'Where there is no guidance, a people falls, but in an abundance of counselors there is safety.', 'Proverbs 11:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, teach the local leaders in %1$s to be humble and to serve others.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 20:26–28', 'prayer-global-porch' ),
                'verse' => _x( 'It shall not be so among you. But whoever would be great among you must be your servant, and whoever would be first among you must be your slave, even as the Son of Man came not to be served but to serve, and to give his life as a ransom for many.', 'Matthew 20:26–28', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, help the local leaders in %1$s to be faithful with what they have been given, whether a little or a lot.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Luke 12:48', 'prayer-global-porch' ),
                'verse' => _x( 'Everyone to whom much was given, of him much will be required, and from him to whom they entrusted much, they will demand the more.', 'Luke 12:48', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, help the local leaders in %1$s not be proud but humble, and willing to wash the feet of all they serve.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'John 13:13–17', 'prayer-global-porch' ),
                'verse' => _x( 'you call me Teacher and Lord, and you are right, for so I am. If I then, your Lord and Teacher, have washed your feet, you also ought to wash one another’s feet. For I have given you an example, that you also should do just as I have done to you. ', 'John 13:13–17', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, may the churches in %1$s honor local leaders who work hard for the flock of God.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Acts 20:28', 'prayer-global-porch' ),
                'verse' => _x( 'Pay careful attention to yourselves and to all the flock, in which the Holy Spirit has made you overseers, to care for the church of God, which he obtained with his own blood.', 'Acts 20:28', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, knowing that teachers will be judged more strictly, help the local leaders in %1$s to be careful with their words.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'James 3:1', 'prayer-global-porch' ),
                'verse' => _x( 'Not many of you should become teachers, my brothers, for you know that we who teach will be judged with greater strictness.', 'James 3:1', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_apostolic_pioneering_leadership( &$lists, $stack, $all = false ) { // local leadership and lay leadership
        $section_label = __( 'Apostles and Pioneers', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please raise up new apostles to pioneer the growth of the church in %s.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, raise up apostolic workers to plant churches in every town in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Titus 1:5', 'prayer-global-porch' ),
                'verse' => _x( 'The reason I left you in Crete was that you might put in order what was left unfinished and appoint elders in every town, as I directed you.', 'Titus 1:5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please send new apostles into the harvest, who can open up new communities for the gospel in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 9:38', 'prayer-global-porch' ),
                'verse' => _x( 'Ask the Lord of the harvest, therefore, to send out workers into his harvest field.', 'Matthew 9:38', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, please give the apostles in %1$s a vision for the harvest, and a passion to see the gospel spread to every corner of the %2$s.', 'prayer-global-porch' ), $stack['location']['full_name'], $stack['location']['admin_level_title'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord of the Harvest, please send out workers into the %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 9:37-38', 'prayer-global-porch' ),
                'verse' => _x( 'Then he said to his disciples, “The harvest is plentiful but the workers are few. Ask the Lord of the harvest, therefore, to send out workers into his harvest field.', 'Matthew 9:37-38', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, please give apostles to expand the church into every neighborhood of %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 28:19-20', 'prayer-global-porch' ),
                'verse' => _x( 'Therefore go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit, and teaching them to obey everything I have commanded you.', 'Matthew 28:19-20', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_evangelistic_leadership( &$lists, $stack, $all = false ) {
        $section_label = __( 'Evangelists and Harvest Workers', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, please raise up evangelists to equip your people to share the gospel in %1$s.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please send new evangelists into the harvest in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 9:38', 'prayer-global-porch' ),
                'verse' => _x( 'Ask the Lord of the harvest, therefore, to send out workers into his harvest field.', 'Matthew 9:38', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, you said you were the giver of evangelists to the church. Please, send more evangelists to the %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => __( 'Evangelists', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'God in Heaven, only you can and should appoint evangelists. Please, appoint and send more to %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( '1 Corinthians 12:28', 'prayer-global-porch' ),
                'verse' => _x( 'And in the church God has appointed first of all apostles, second prophets, third teachers, then workers of miracles, and those with gifts of healing, helping, administration, and various tongues.', '1 Corinthians 12:28', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, encourage every believer in %1$s to do the work of an evangelist with their friends and neighbors.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 4:5', 'prayer-global-porch' ),
                'verse' => _x( 'But you, keep your head in all situations, endure hardship, do the work of an evangelist ...', 'Ephesians 4:5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help every believer in %1$s be prepared to give an answer to everyone who asks them for the reason for their hope.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( '1 Peter 3:15', 'prayer-global-porch' ),
                'verse' => _x( 'But in your hearts revere Christ as Lord. Always be prepared to give an answer to everyone who asks you to give the reason for the hope that you have. But do this with gentleness and respect.', '1 Peter 3:15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, send out evangelists who will challenge people like Peter who said, "Repent and be baptized, every one of you" in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Acts 2:38', 'prayer-global-porch' ),
                'verse' => _x( 'Peter replied, “Repent and be baptized, every one of you, in the name of Jesus Christ for the forgiveness of your sins. And you will receive the gift of the Holy Spirit.', 'Acts 2:38', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, please give your people in %1$s a passion for the lost.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( '2 Corinthians 5:20', 'prayer-global-porch' ),
                'verse' => _x( 'We are therefore Christ’s ambassadors, as though God were making his appeal through us. We implore you on Christ’s behalf: Be reconciled to God.', '2 Corinthians 5:20', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_prophetic_leadership( &$lists, $stack, $all = false ) {
        $section_label = __( 'Prophets and Truth Speakers', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please raise up prophets in %1$s who can call the church to holiness and purity, preparing your church as a bride for your Son.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please give the church in %1$s of %2$s prophets who can build up holiness and faithfulness to you.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, you already know the names of the prophets you want to raise up in %1$s. Please, raise them up and give them the courage to speak your truth to your church.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Jeremiah 1:5', 'prayer-global-porch' ),
                'verse' => _x( 'Before I formed you in the womb I knew you, and before you were born I consecrated you; I appointed you a prophet to the nations.', 'Jeremiah 1:5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, like in the church of Antioch, where you gathered many prophets and teachers, please gather many prophets and teachers in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Acts 13:1', 'prayer-global-porch' ),
                'verse' => _x( 'Now in the church at Antioch there were prophets and teachers: Barnabas, Simeon called Niger, Lucius of Cyrene, Manaen (who had been brought up with Herod the tetrarch), and Saul.', 'Acts 13:1', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, make bold the prophets in %1$s so that the church can be equipped with truth and insight and a vision of your heart.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Zechariah 8:16', 'prayer-global-porch' ),
                'verse' => _x( 'These are the things which you should do: speak the truth to one another; judge with truth and judgment for peace in your gates.', 'Zechariah 8:16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, raise up prophets and truth speakers in your church in %1$s so that the church can grow in every way into the mature body of you its head.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 4:15', 'prayer-global-porch' ),
                'verse' => _x( 'Instead, speaking the truth in love, we will grow to become in every respect the mature body of him who is the head, that is, Christ.', 'Ephesians 4:15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, make the church in %1$s humble and willing to hear the sometimes hard voices of prophets bringing the light of truth on them.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Galatians 4:16', 'prayer-global-porch' ),
                'verse' => _x( 'So have I become your enemy by telling you the truth?', 'Galatians 4:16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, strengthen the church in %1$s by giving a prophet, as you said you would, who is bold and willing to correct. Lord, may the believers care about holiness as you do.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.', 'Ephesians 4:11', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
//                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.', 'Ephesians 4:11', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Ephesians 4:11', 'prayer-global-porch' ),
//                'verse' => _x( 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.', 'Ephesians 4:11', 'prayer-global-porch' ),
//            ],

        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_shepherding_leadership( &$lists, $stack, $all = false ) {
        $section_label = __( 'Shepherds and Pastors', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, give grace to the local leaders who shepherd the %1$s believers in %2$s of %3$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'John 10:11', 'prayer-global-porch' ),
                'verse' => _x( 'I am the good shepherd. The good shepherd lays down his life for the sheep.', 'John 10:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, please provide elders whose hearts are completely yours in every town in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Titus 1:5', 'prayer-global-porch' ),
                'verse' => _x( 'The reason I left you in Crete was that you might put in order what was left unfinished and appoint elders in every town, as I directed you.', 'Titus 1:5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, please bless the leaders of the %1$s of %2$s who work hard at shepherding and guiding your people.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 78:72', 'prayer-global-porch' ),
                'verse' => _x( 'With upright heart he shepherded them and guided them with his skillful hand.', 'Psalm 78:72', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, encourage every one of the %1$s ordinary believers here to care for others, like a shepherd cares for his sheep.', 'prayer-global-porch' ), $stack['location']['believers'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, you gave the church of %1$s the greatest shepherd of all time, Jesus. Please, help them listen to him.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ezekiel 34:23', 'prayer-global-porch' ),
                'verse' => _x( 'I will place over them one shepherd, my servant David, and he will tend them; he will tend them and be their shepherd.', 'Ezekiel 34:23', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, for all those you call to look after your flock from the %1$s believers in %2$s, please, make them passionate about hearing your Word.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( 'Ezekiel 34:7', 'prayer-global-porch' ),
                'verse' => _x( 'Therefore, you shepherds, hear the word of the LORD.', 'Ezekiel 34:7', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Good Shepherd, thank you that you know the name of each of the %1$s believers in %2$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( 'John 10:14', 'prayer-global-porch' ),
                'verse' => _x( 'I am the good shepherd; I know my sheep and my sheep know me', 'John 10:14', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_teaching_leadership( &$lists, $stack, $all = false ) {
        $section_label = __( 'Teachers', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please send teachers of your Word in %1$s who can speak your gospel boldly and clearly.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, build the strength and maturity of the local leaders in %1$s. Show them that faithfulness is more important than knowledge. Show them that the Spirit, the Word, and prayer is enough in order to grow and lead. ', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, for the leaders in %1$s of %2$s, let the eyes of their hearts be enlightened in order that they may know the hope to which they are called.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Ephesians 1:18', 'prayer-global-porch' ),
                'verse' => _x( 'I pray that the eyes of your heart may be enlightened in order that you may know the hope to which he has called you, the riches of his glorious inheritance in his holy people, and his incomparably great power for us who believe. ', 'Ephesians 1:18', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please send new teachers into the harvest, who can correct the lies of our enemy in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 9:38', 'prayer-global-porch' ),
                'verse' => _x( 'Ask the Lord of the harvest, therefore, to send out workers into his harvest field.', 'Matthew 9:38', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, the believers in %1$s of %2$s need teachers who can feed them with knowledge and understanding. Please raise them up.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['full_name'] ),
                'reference' => __( 'Jeremiah 3:15', 'prayer-global-porch' ),
                'verse' => _x( 'Then I will give you shepherds after My own heart, who will feed you with knowledge and understanding.', 'Jeremiah 3:15', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }


    public static function _for_biblical_authority( &$lists, $stack, $all = false ) {
        $section_label = __( 'Biblical Authority', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, make the Word of God a delight to the people of %1$s, like it was to David.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:16', 'prayer-global-porch' ),
                'verse' => _x( 'I delight in your decrees, I will not neglect your Word.', 'Psalm 119:16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, instill a desire within the people of the %1$s of %2$s to hide your Word in their heart.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:11', 'prayer-global-porch' ),
                'verse' => _x( 'I have hidden your Word in my heart that I might not sin against you.', 'Psalm 119:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, help the people of the %1$s of %2$s to be consumed with longing for your Word at all times, like David.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:20', 'prayer-global-porch' ),
                'verse' => _x( 'My soul is consumed with longing for your laws at all times.', 'Psalm 119:20', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, teach your Word to the people of the %1$s of %2$s, so that they can follow your ways all their life.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:33', 'prayer-global-porch' ),
                'verse' => _x( 'Teach me, Lord, the way of your decrees, that I may follow it to the end.', 'Psalm 119:33', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, teach the disciples in %1$s of %2$s to trust your Word, like a lamp, in the darkness around them.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:105', 'prayer-global-porch' ),
                'verse' => _x( 'your Word is a lamp for my feet, a light on my path.', 'Psalm 119:105', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, teach the young people in %1$s of %2$s to trust your Word and find the path of purity.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:9', 'prayer-global-porch' ),
                'verse' => _x( 'How can a young person stay on the path of purity? By living according to your Word.', 'Psalm 119:9', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, we know that cultures come and go, even in %1$s of %2$s, but the truth of your Word endures generations.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:89', 'prayer-global-porch' ),
                'verse' => _x( 'your Word, Lord, is eternal; it stands firm in the heavens.', 'Psalm 119:89', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, defend those who are loyal to your Word in %1$s of %2$s, even against fierce enemies.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:61', 'prayer-global-porch' ),
                'verse' => _x( 'Though the wicked bind me with ropes, I will not forget your law.', 'Psalm 119:61', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, fill the %1$s souls living in %2$s of %3$s with a taste for your Word. Make it sweet as honey in their mouth.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:103', 'prayer-global-porch' ),
                'verse' => _x( 'How sweet are your Words to my taste, sweeter than honey to my mouth!', 'Psalm 119:103', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, fill the %1$s believers in %2$s of %3$s with tears, because God is not obeyed by those around them.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:136', 'prayer-global-porch' ),
                'verse' => _x( 'Streams of tears flow from my eyes, for your law is not obeyed.', 'Psalm 119:136', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, guide the %1$s believers in %2$s of %3$s into all truth as they interpret Scriptures.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Hebrews 4:12', 'prayer-global-porch' ),
                'verse' => _x( 'For the Word of God is alive and active. Sharper than any two-edged sword, it penetrates even to dividing soul and spirit, joints and marrow.', 'Hebrews 4:12', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, we pray that the people of %1$s will learn to study the Bible, understand it, obey it, and share it.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, let knowledge and depth of insight abound more and more in the church of %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Philippians 1:9', 'prayer-global-porch' ),
                'verse' => _x( 'And this is my prayer: that your love may abound more and more in knowledge and depth of insight', 'Philippians 1:9', 'prayer-global-porch' ),
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_obedience( &$lists, $stack, $all = false ) {
        $section_label = __( 'Obedience', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, cause the %1$s believers in %2$s to obey with immediate, radical, costly obedience, like Abraham.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( 'Genesis 22:2-3', 'prayer-global-porch' ),
                'verse' => _x( 'Then God said, “Take your son, your only son, whom you love — Isaac — and go to the region of Moriah. Sacrifice him there as a burnt offering on a mountain I will show you.” Early the next morning Abraham got up and loaded his donkey. He took with him two of his servants and his son Isaac. When he had cut enough wood for the burnt offering, he set out for the place God had told him about.', 'Genesis 22:2-3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, teach the believers in %1$s of %2$s that love for you and obedience to you are connected.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'John 14:15', 'prayer-global-porch' ),
                'verse' => _x( 'If you love me, keep my commands.', 'John 14:15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, remind the disciples in %1$s of %2$s to train each other to obey all that you commanded, and that you will be with them as they do it.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 28:20', 'prayer-global-porch' ),
                'verse' => _x( '...teaching them to obey everything I have commanded you. And surely I am with you always, to the very end of the age.', 'Matthew 28:20', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, please help the %1$s believers in %2$s of %3$s to be filled with joyful obedience at all times, as you modeled for us all.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, help the %1$s believers in %2$s to know that you can make a big impact through their simple obedience today.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( 'Exodus 19:6', 'prayer-global-porch' ),
                'verse' => _x( '... you will be for me a kingdom of priests ...', 'Exodus 19:6', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, help the %1$s believers in %2$s to know your commands and to do them.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( 'Ezra 7:10,25', 'prayer-global-porch' ),
                'verse' => _x( 'For Ezra had prepared his heart to seek the law of the LORD, and to do it, and to teach in Israel statutes and judgments.', 'Ezra 7:10,25', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Psalm 119:10', 'prayer-global-porch' ),
//                'verse' => _x( 'I seek you with all my heart; do not let me stray from your commands.', 'Psalm 119:10', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_reliance_on_god( &$lists, $stack, $all = false ) {
        $section_label = __( 'Reliance on God', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => __( 'Trust', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Father, move the %1$s believers in %2$s of %3$s to say "Not our will, but yours be done", like Jesus.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Luke 22:41-42', 'prayer-global-porch' ),
                'verse' => _x( 'He withdrew about a stone’s throw beyond them, knelt down and prayed, "Father, if you are willing, take this cup from me; yet not my will, but yours be done."', 'Luke 22:41-42', 'prayer-global-porch' ),
            ],
            [
                'section_label' => __( 'Suffering', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Spirit, please defend the %1$s believers in %2$s against an unwillingness to suffer. Give them courage to face social rejection.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => __( 'Trust', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Please, convict the %1$s believers in %2$s to look to you as their only hope for strength and fruitfulness and life.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( 'John 15:5', 'prayer-global-porch' ),
                'verse' => _x( 'I am the vine; you are the branches. If you remain in me and I in you, you will bear much fruit; apart from me you can do nothing.', 'John 15:5', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, look after and teach the way that is best for the %1$s believers living in %2$s.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['full_name'] ),
                'reference' => __( 'Psalm 32:8', 'prayer-global-porch' ),
                'verse' => _x( 'I will instruct you and teach you in the way which you shall go. I will counsel you with my eye on you.', 'Psalm 32:8', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, train the church of %1$s to trust with all their hearts, and you will make their paths straight.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Proverbs 3:5-6', 'prayer-global-porch' ),
                'verse' => _x( 'Trust in Yahweh with all your heart, and don’t lean on your own understanding. In all your ways acknowledge him, and he will make your paths straight.', 'Proverbs 3:5-6', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, remind your church in %1$s that they can know and depend on the love you have for them.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( '1 John 4:16', 'prayer-global-porch' ),
                'verse' => _x( 'We know and have believed the love which God has for us. God is love, and he who remains in love remains in God, and God remains in him.', '1 John 4:16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, encourage your church in %1$s that you never forsake them.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Psalm 9:10', 'prayer-global-porch' ),
                'verse' => _x( 'Those who know your name will put their trust in you, for you, Yahweh, have not forsaken those who seek you.', 'Psalm 9:10', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, reveal your kingdom to those with a childlike heart in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 11:25-26', 'prayer-global-porch' ),
                'verse' => _x( 'At that time, Jesus answered, “I thank you, Father, Lord of heaven and earth, that you hid these things from the wise and understanding, and revealed them to infants. Yes, Father, for so it was well-pleasing in your sight.', 'Matthew 11:25-26', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, teach the %1$s believers that their old life is dead and their new life is hid with Christ.', 'prayer-global-porch' ), $stack['location']['believers'] ),
                'reference' => __( 'Colossians 3:3', 'prayer-global-porch' ),
                'verse' => _x( 'For you died, and your life is hidden with Christ in God.', 'Colossians 3:3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, to the people of %1$s you say, "If you wait for Me, I will work on your behalf."', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Isaiah 64:4', 'prayer-global-porch' ),
                'verse' => _x( 'For from of old men have not heard, nor perceived by the ear, neither has the eye seen a God besides you, who works for him who waits for him.', 'Isaiah 64:4', 'prayer-global-porch' ),
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_faithfulness( &$lists, $stack, $all = false ) {
        $section_label = __( 'Prayer Movement', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => __( 'Faith', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Spirit, teach the %1$s believers in %2$s that when they seek first your Kingdom and your righteousness, you will abundantly provide all they need.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( '2 Corinthians 9:8', 'prayer-global-porch' ),
                'verse' => _x( 'And God is able to bless you abundantly, so that in all things at all times, having all that you need, you will abound in every good work.', '2 Corinthians 9:8', 'prayer-global-porch' ),
            ],
            [
                'section_label' => __( 'Faith', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Lord, please give the %1$s believers in %2$s of %3$s the Spirit of wisdom and revelation, so that they might know you better.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Ephesians 1:17', 'prayer-global-porch' ),
                'verse' => _x( 'I keep asking that the God of our Lord Jesus Christ, the glorious Father, may give you the Spirit of wisdom and revelation, so that you may know him better.', 'Ephesians 1:17', 'prayer-global-porch' ),
            ],

            [
                'section_label' => __( 'Faith', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Spirit, please defend the %1$s believers in %2$s against self-centered spirituality. Open their eyes to the fields ripe for harvest around them.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => __( 'Faithfulness', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Father, convict the %1$s believers in %2$s to be holy and righteous. Inspire them to gather in small groups for accountability and spiritual growth.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => __( 'Faithfulness', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Lord, we know that you invest more in those who have been faithful with what they have been given. Please, richly bless each faithful believer in %1$s with more spiritual insight, wisdom, courage and vision.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => __( 'Matthew 25:28', 'prayer-global-porch' ),
                'verse' => _x( 'So take the bag of gold from him and give it to the one who has ten bags. For whoever has will be given more, and they will have an abundance. Whoever does not have, even what they have will be taken from them.', 'Matthew 25:28', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, please reward those who diligently seek you with a heart of faith in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Hebrews 11:6', 'prayer-global-porch' ),
                'verse' => _x( 'Without faith it is impossible to be well pleasing to him, for he who comes to God must believe that he exists, and that he is a rewarder of those who seek him.', 'Hebrews 11:6', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, sanctify the %1$s believers in %2$s and keep them blameless until Jesus returns.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( '1 Thessalonians 5:23-24', 'prayer-global-porch' ),
                'verse' => _x( 'May the God of peace himself sanctify you completely. May your whole spirit, soul, and body be preserved blameless at the coming of our Lord Jesus Christ. He who calls you is faithful, who will also do it.', '1 Thessalonians 5:23-24', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Hebrews 11:6', 'prayer-global-porch' ),
//                'verse' => _x( 'And without faith, it is impossible to please Him, for he who comes to God must believe that He is and that He is a rewarder of those who seek Him.', 'Hebrews 11:6', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Lamentations 3:25', 'prayer-global-porch' ),
//                'verse' => _x( 'The LORD is good to them that wait for him, to the soul that seeks him.', 'Lamentations 3:25', 'prayer-global-porch' ),
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => __( 'Psalm 119:2', 'prayer-global-porch' ),
//                'verse' => _x( 'How blessed are those who observe His testimonies, who seek Him with all their heart?', 'Psalm 119:2', 'prayer-global-porch' ),
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_suffering( &$lists, $stack, $all = false ) {
        $section_label = __( 'Suffering', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, let those from the %1$s believers who are shaken and weak remember that your love will never fail them.', 'prayer-global-porch' ), $stack['location']['believers'] ),
                'reference' => __( '1 Corinthians 13:8', 'prayer-global-porch' ),
                'verse' => _x( 'Love never fails. But where there are prophecies, they will be done away with. Where there are various languages, they will cease. Where there is knowledge, it will be done away with.', '1 Corinthians 13:8', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, put the people who are lonely into families in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 68:6', 'prayer-global-porch' ),
                'verse' => _x( 'God sets the lonely in families. He brings out the prisoners with singing, but the rebellious dwell in a sun-scorched land.', 'Psalm 68:6', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, protect the overcomers in %1$s, so that they will one day sit with Jesus on His throne.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Revelation 3:21', 'prayer-global-porch' ),
                'verse' => _x( 'He who overcomes, I will give to him to sit down with me on my throne, as I also overcame, and sat down with my Father on his throne.', 'Revelation 3:21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, you have chosen the weak things of this world to confound the strong. Make the poor and outcast in %1$s of %2$s a testimony of your strength.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '1 Corinthians 1:27', 'prayer-global-porch' ),
                'verse' => _x( 'God chose the foolish things of the world that he might put to shame those who are wise. God chose the weak things of the world, that he might put to shame the things that are strong;', '1 Corinthians 1:27', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, encourage the church of %1$s that they are blessed with every heavenly blessing.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 1:3', 'prayer-global-porch' ),
                'verse' => _x( 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenly places in Christ', 'Ephesians 1:3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, thank you that you will never abandon the church of %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Hebrews 13:5 ', 'prayer-global-porch' ),
                'verse' => _x( 'Be free from the love of money, content with such things as you have, for he has said, “I will in no way leave you, neither will I in any way forsake you.', 'Hebrews 13:5 ', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, for those distressed and afraid in %1$s, show them today that you give peace at all times and in every situation.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( '2 Thessalonians 3:16', 'prayer-global-porch' ),
                'verse' => _x( 'Now may the Lord of peace himself give you peace at all times in all ways. The Lord be with you all.', '2 Thessalonians 3:16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, please find the broken hearted among the %1$s souls in %2$s and mend their wounds.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 147:3', 'prayer-global-porch' ),
                'verse' => _x( 'He heals the broken in heart, and binds up their wounds.', 'Psalm 147:3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, comfort those who mourn in %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 5:4', 'prayer-global-porch' ),
                'verse' => _x( 'Blessed are those who mourn, for they shall be comforted.', 'Matthew 5:4', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, see the suffering of your people in %1$s of %2$s. Deliver all those who have not forgotten your Word.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Psalm 119:153', 'prayer-global-porch' ),
                'verse' => _x( 'Look on my suffering and deliver me, for I have not forgotten your law.', 'Psalm 119:153', 'prayer-global-porch' ),
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_love_and_generosity( &$lists, $stack, $all = false ) {
        $section_label = __( 'Love', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, give the believers of the %1$s of %2$s unity and humility as they work to bring the kingdom to new people and places.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, stir the hearts of your people in %1$s to agree with you and with one another.', 'prayer-global-porch' ), $stack['location']['name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, stir the hearts of your people in %1$s of %2$s to agree with you and with one another in love.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'John 17:21', 'prayer-global-porch' ),
                'verse' => _x( 'that all of them may be one, Father, just as you are in me and I am in you. May they also be in us so that the world may believe that you have sent me.', 'John 17:21', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Lord, we pray for the believers in %1$s to be more like Jesus in their love for friends and enemies.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Matthew 5:44', 'prayer-global-porch' ),
                'verse' => _x( 'But I tell you, love your enemies and pray for those who persecute you.', 'Matthew 5:44', 'prayer-global-porch' ),
            ],
            [
                'section_label' => __( 'The Church', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'Father, let love abound more and more in the church of %1$s.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Philippians 1:9', 'prayer-global-porch' ),
                'verse' => _x( 'And this is my prayer: that your love may abound more and more in knowledge and depth of insight', 'Philippians 1:9', 'prayer-global-porch' ),
            ],
            [
                'section_label' => __( 'Generosity', 'prayer-global-porch' ),
                'prayer' => sprintf( __( 'God, we pray for the believers in %1$s to be generous so that they would be worthy of greater investment by you.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, encourage the %1$s believers in %2$s to not just be consumers of knowledge but be producers of love, mercy, kindness, and justice.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['name'] ),
                'reference' => __( '1 John 3:18', 'prayer-global-porch' ),
                'verse' => _x( '...let us not love with words or speech but with actions and in truth.', '1 John 3:18', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Oh Lord, show the fatherless in %1$s of %2$s that you can be their real Father.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '2 Corinthians 6:18', 'prayer-global-porch' ),
                'verse' => _x( 'I will be to you a Father. you will be to me sons and daughters,’ says the Lord Almighty.', '2 Corinthians 6:18', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_kingdom_urgency( &$lists, $stack, $all = false ) {
        $section_label = __( 'Urgency', 'prayer-global-porch' );
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, give the disciples of the %1$s of %2$s an urgency of seeing every people and place reached for the gospel.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'John 9:4', 'prayer-global-porch' ),
                'verse' => _x( 'As long as it is day, we must do the works of him who sent me. Night is coming, when no one can work.', 'John 9:4', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, encourage the disciples in %1$s to live with urgency and a passion for making more disciples.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'James 4:14', 'prayer-global-porch' ),
                'verse' => _x( 'Yet you do not know what your life will be like tomorrow. you are just a vapor that appears for a little while and then vanishes away.', 'James 4:14', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, defend the church in %1$s of %2$s against being inward-focused.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Isaiah 61:1', 'prayer-global-porch' ),
                'verse' => _x( 'The Spirit of the Sovereign LORD is on me, because the LORD has anointed me to proclaim good news to the poor. He has sent me to bind up the brokenhearted, to proclaim freedom for the captives and release from darkness for the prisoners.', 'Isaiah 61:1', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, encourage the church in %1$s to make the most of every opportunity.', 'prayer-global-porch' ), $stack['location']['full_name'] ),
                'reference' => __( 'Ephesians 5:15', 'prayer-global-porch' ),
                'verse' => _x( 'Be very careful, then, how you live—not as unwise but as wise, making the most of every opportunity, because the days are evil.', 'Ephesians 5:15', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, your return is closer than when we first believed. Please, set urgency in the hearts of the people living in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Romans 13:11', 'prayer-global-porch' ),
                'verse' => _x( 'Besides this you know the time, that the hour has come for you to wake from sleep. For salvation is nearer to us now than when we first believed.', 'Romans 13:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, disrupt complacency in the %1$s believers living in %2$s of %3$s. Remind them you are coming soon.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 24:42', 'prayer-global-porch' ),
                'verse' => _x( 'Therefore, stay awake, for you do not know on what day your Lord is coming.', 'Matthew 24:42', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, give faith and responsive hearts to the %1$s citizens of the %2$s of %3$s.', 'prayer-global-porch' ), $stack['location']['population'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Isaiah 55:6', 'prayer-global-porch' ),
                'verse' => _x( 'Seek the Lord while he may be found; call upon him while he is near;', 'Isaiah 55:6', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, renew the call of John the Baptist in %1$s of %2$s. Send out bold servants who will call all to repent.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Matthew 3:2', 'prayer-global-porch' ),
                'verse' => _x( 'Repent, for the kingdom of heaven is at hand.', 'Matthew 3:2', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Father, set on fire the hearts and passion of your church in %1$s of %2$s.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Romans 12:11', 'prayer-global-porch' ),
                'verse' => _x( 'Do not be slothful in zeal, be fervent in spirit, serve the Lord.', 'Romans 12:11', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Spirit, awaken the sleepers and call them to repent and be baptized in %1$s of %2$s. Set an urgency in their hearts.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Acts 22:16', 'prayer-global-porch' ),
                'verse' => _x( 'And now why do you wait? Rise and be baptized and wash away your sins, calling on his name.’', 'Acts 22:16', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, defend your people in %1$s of %2$s against the difficulty of these last days.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( '2 Timothy 3:1-4', 'prayer-global-porch' ),
                'verse' => _x( 'But understand this, that in the last days there will come times of difficulty. For people will be lovers of self, lovers of money, proud, arrogant, abusive, disobedient to their parents, ungrateful, unholy, heartless, unappeasable, slanderous, without self-control, brutal, not loving good, treacherous, reckless, swollen with conceit, lovers of pleasure rather than lovers of God, having the appearance of godliness, but denying its power.', '2 Timothy 3:1-4', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Jesus, purify the %1$s believers in %2$s of %3$s to not just be hearers, but doers of your Word.', 'prayer-global-porch' ), $stack['location']['believers'], $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Revelation 1:3', 'prayer-global-porch' ),
                'verse' => _x( 'Blessed is the one who reads aloud the words of this prophecy, and blessed are those who hear, and who keep what is written in it, for the time is near.', 'Revelation 1:3', 'prayer-global-porch' ),
            ],
            [
                'section_label' => $section_label,
                'prayer' => sprintf( __( 'Holy Spirit, have mercy on the simple who turned from you in %1$s of %2$s. Warn them again against their complacency.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], $stack['location']['name'] ),
                'reference' => __( 'Proverbs 1:32', 'prayer-global-porch' ),
                'verse' => _x( 'For the simple are killed by their turning away, and the complacency of fools destroys them;', 'Proverbs 1:32', 'prayer-global-porch' ),
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }


    public static function _cities( &$lists, $stack, $all = false ) {

        if ( empty( $stack['location']['cities_list_w_pop'] ) ) {
            return $lists;
        }
        $templates = [
            [
                'section_label' => sprintf( __( 'Cities in %s', 'prayer-global-porch' ), $stack['location']['name'] ),
                'prayer' => sprintf( __( 'Jesus, bring your gospel to the people living in %1$s.', 'prayer-global-porch' ), $stack['location']['cities_list'] ),
                'reference' => __( 'Matthew 28:19-20', 'prayer-global-porch' ),
                'verse' => _x( 'Therefore go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit, and teaching them to obey everything I have commanded you.', 'Matthew 28:19-20', 'prayer-global-porch' ),
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '',
//                'verse' => '',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }



    /* Illustration based blocks */
    public static function least_reached_text( $stack): array
    {
        /**
         * Least Reached Block
         */
        return [
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord we ask you on behalf of the %1$s people. %2$s%% are known to be believers. Oh God, please share with them the great gift of your son Jesus and your kingdom.', 'prayer-global-porch' ), $stack['least_reached']['name'], number_format( (float) $stack['least_reached']['PercentEvangelical'], 1 ) ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord, please remember the %1$s people. you said you wanted worshippers of every tongue and tribe and nation, yet we know of no worshippers among them.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord, you sent Jesus as a witness to testify about the light so that all the %1$s people might believe through him.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord, bring the blind by a way that they don’t know. Lead the %1$s people in paths that they don’t know. Make darkness light before them and crooked places straight. Do not forsake the %2$s people.', 'prayer-global-porch' ), $stack['least_reached']['name'], $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord, I thank you that you will bring health and a cure to the %1$s people. Reveal to them abundance of peace and truth.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Father, open to your people a door for the word, to speak the mystery of Christ to the %1$s people.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Father, I pray against the principalities, against the powers, against the world’s rulers of darkness of this age, and against the spiritual forces of the wickedness in the heavenly places that are warring against the %1$s people.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Jesus, I pray that all the %1$s people will remember and turn to you, Lord God. May all the %2$s people worship before you. For the kingdom of the %3$s people is yours.', 'prayer-global-porch' ), $stack['least_reached']['name'], $stack['least_reached']['name'], $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord God, I thank you that the blood of Christ, who through the eternal Spirit offered himself without defect to God, can cleanse the %1$s people conscience from dead works to serve the living God.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Spirit, I pray that the %1$s people will come and worship before you, Lord. May they glorify your name for you are great.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord, Let your Kingdom come among the %1$s people. Let your will be done, as in heaven, so on earth.', 'prayer-global-porch' ), $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Lord, remember the %1$s people. Make the %2$s people a chosen race, a royal priesthood, a holy nation, a people for your own possession.', 'prayer-global-porch' ), $stack['least_reached']['name'], $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Father, I pray that the %1$s people will not be afraid or ashamed. Prevent them from being confounded or disappointed in their search for you. May the %2$s people know you.', 'prayer-global-porch' ), $stack['least_reached']['name'], $stack['least_reached']['name'] ),
            ],
            [
                'section_summary' => '',
                'prayer' => sprintf( __( 'Father, %1$s%% are known to be believers. Please, Lord call more today.', 'prayer-global-porch' ), number_format( (float) $stack['least_reached']['PercentEvangelical'], 1 ) ),
            ],
        ];
    }

    public static function photos_text( $stack): array
    {
        /**
         * Photos Block
         */
        return [
            [
                'section_summary' => __( 'What people or activities could you pray for in this photo?', 'prayer-global-porch' ),
                'prayer' => '',
            ],
            [
                'section_summary' => __( 'What people or resources could you pray for in this photo?', 'prayer-global-porch' ),
                'prayer' => '',
            ],
            [
                'section_summary' => __( 'What needs would people have here?', 'prayer-global-porch' ),
                'prayer' => '',
            ],
            [
                'section_summary' => __( 'What blessing is needed here?', 'prayer-global-porch' ),
                'prayer' => '',
            ],
            [
                'section_summary' => __( 'What conditions of religion or environment could you pray for here?', 'prayer-global-porch' ),
                'prayer' => '',
            ],
            [
                'section_summary' => __( 'What challenges do people here face?', 'prayer-global-porch' ),
                'prayer' => '',
            ],
            [
                'section_summary' => __( 'What beauty can God be thanked for in this photo?', 'prayer-global-porch' ),
                'prayer' => '',
            ],
        ];
    }

    public static function key_city_text( $stack, $key_city): array
    {
        /**
         * Key City Block
         */
        return [
            [
                'section_summary' => sprintf( __( 'Pray that God raises up new churches in the city of %s.', 'prayer-global-porch' ), $key_city['full_name'] ),
            ],
        ];
    }

    public static function cities_text( $stack): array
    {
        /**
         * Key City Block
         */
        return [
            [
                'prayer' => sprintf( __( 'Pray that God encourage his people in all these cities.', 'prayer-global-porch' ) ),
            ],
            [
                'prayer' => sprintf( __( 'Pray that new churches are planted in these cities.', 'prayer-global-porch' ) ),
            ],
        ];
    }

    public static function demographics_content_text( $stack): array
    {

        return [
            /**
             * PRAYERS TARGETING BELIEVERS
             */
            'believers' => [
                [
                    'section_summary' => sprintf( _x( '%1$s of %2$s has a population of %3$s.', 'The state of Colorado has a population of 5,773,714.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], '<strong>'.$stack['location']['full_name'].'</strong>', '<strong>'.$stack['location']['population'].'</strong>' ).
                        '<br><br>'.
                        sprintf( _x( 'We estimate %1$s has %2$s people who might know Jesus, %3$s people who might know about Jesus culturally, and %4$s people who do not know Jesus.', 'We estimate new york has 100 people who might know Jesus, 300 people who might know about Jesus culturally, and 500 people who do not know Jesus.', 'prayer-global-porch' ), $stack['location']['name'], '<strong>'.$stack['location']['believers'].'</strong>', '<strong>'.$stack['location']['christian_adherents'].'</strong>', '<strong>'.$stack['location']['non_christians'].'</strong>' ).
                        '<br><br>'.
                        sprintf( __( 'This is %1$s believer for every %2$s neighbors who need Jesus.', 'prayer-global-porch' ), '<strong>1</strong>', '<strong>'.$stack['location']['lost_per_believer'].'</strong>' ) ,
                ],
            ],
            /**
             * PRAYERS TARGETING CULTURAL CHRISTIANS
             */
            'christian_adherents' => [
                [
                    'section_summary' => sprintf( _x( '%1$s of %2$s has a population of %3$s.', 'The state of Colorado has a population of 5,773,714.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], '<strong>'.$stack['location']['full_name'].'</strong>', '<strong>'.$stack['location']['population'].'</strong>' ).
                        '<br><br>'.
                        sprintf( _x( 'We estimate %1$s has %2$s people who might know Jesus, %3$s people who might know about Jesus culturally, and %4$s people who do not know Jesus.', 'We estimate new york has 100 people who might know Jesus, 300 people who might know about Jesus culturally, and 500 people who do not know Jesus.', 'prayer-global-porch' ), $stack['location']['name'], '<strong>'.$stack['location']['believers'].'</strong>', '<strong>'.$stack['location']['christian_adherents'].'</strong>', '<strong>'.$stack['location']['non_christians'].'</strong>' ).
                        '<br><br>'.
                        sprintf( __( 'This is %1$s believer for every %2$s neighbors who need Jesus.', 'prayer-global-porch' ), '<strong>1</strong>', '<strong>'.$stack['location']['lost_per_believer'].'</strong>' ) ,
                ],
            ],
            /**
             * PRAYERS TARGETING NON CHRISTIANS
             */
            'non_christians' => [
                [
                    'section_summary' => sprintf( _x( '%1$s of %2$s has a population of %3$s.', 'The state of Colorado has a population of 5,773,714.', 'prayer-global-porch' ), $stack['location']['admin_level_title'], '<strong>'.$stack['location']['full_name'].'</strong>', '<strong>'.$stack['location']['population'].'</strong>' ).
                        '<br><br>'.
                        sprintf( _x( 'We estimate %1$s has %2$s people who might know Jesus, %3$s people who might know about Jesus culturally, and %4$s people who do not know Jesus.', 'We estimate new york has 100 people who might know Jesus, 300 people who might know about Jesus culturally, and 500 people who do not know Jesus.', 'prayer-global-porch' ), $stack['location']['name'], '<strong>'.$stack['location']['believers'].'</strong>', '<strong>'.$stack['location']['christian_adherents'].'</strong>', '<strong>'.$stack['location']['non_christians'].'</strong>' ).
                        '<br><br>'.
                        sprintf( __( 'This is %1$s believer for every %2$s neighbors who need Jesus.', 'prayer-global-porch' ), '<strong>1</strong>', '<strong>'.$stack['location']['lost_per_believer'].'</strong>' ) ,
                ],
            ]
        ];

    }

    public static function demogrphics_4_fact_text( $stack): array
    {

        return [
            /**
             * PRAYERS TARGETING BELIEVERS
             */
            'believers' => [
                [
                    'prayer' => '',
                ],
            ],
            /**
             * PRAYERS TARGETING CULTURAL CHRISTIANS
             */
            'christian_adherents' => [
                [
                    'prayer' => '',
                ],
            ],
            /**
             * PRAYERS TARGETING NON CHRISTIANS
             */
            'non_christians' => [
                [
                    'prayer' => '',
                ],
            ]
        ];

    }

}


/**
 * (
[location] => Array
        (
        [grid_id] => 100219785
        [name] => Saiha
        [admin0_name] => India
        [full_name] => Saiha, Mizoram, India
        [population] => 22,700
        [latitude] => 22.3794
        [longitude] => 93.0146
        [country_code] => IN
        [admin0_code] => IND
        [parent_id] => 100219370
        [parent_name] => Mizoram
        [admin0_grid_id] => 100219347
        [admin1_grid_id] => 100219370
        [admin1_name] => Mizoram
        [admin2_grid_id] => 100219785
        [admin2_name] => Saiha
        [admin3_grid_id] =>
        [admin3_name] =>
        [admin4_grid_id] =>
        [admin4_name] =>
        [admin5_grid_id] =>
        [admin5_name] =>
        [level] => 2
        [level_name] => admin2
        [north_latitude] => 22.8106
        [south_latitude] => 21.9462
        [east_longitude] => 93.2093
        [west_longitude] => 92.827
        [p_longitude] => 92.8362
        [p_latitude] => 23.3068
        [p_north_latitude] => 24.5208
        [p_south_latitude] => 21.9462
        [p_east_longitude] => 93.4447
        [p_west_longitude] => 92.2594
        [c_longitude] => 82.8007
        [c_latitude] => 21.1278
        [c_north_latitude] => 35.5013
        [c_south_latitude] => 6.75426
        [c_east_longitude] => 97.4152
        [c_west_longitude] => 68.1862
        [peer_locations] => 8
        [birth_rate] => 18.7
        [death_rate] => 7.2
        [growth_rate] => 1.115
        [believers] => 250
        [christian_adherents] => 275
        [non_christians] => 22,175
        [primary_language] => Hindi
        [primary_religion] => Hinduism
        [percent_believers] => 1.1
        [percent_christian_adherents] => 1.21
        [percent_non_christians] => 97.69
        [admin_level_title] => county
        [admin_level_title_plural] => counties
        [population_int] => 22700
        [believers_int] => 250
        [christian_adherents_int] => 275
        [non_christians_int] => 22175
        [percent_believers_full] => 1.1
        [percent_christian_adherents_full] => 1.21333
        [percent_non_christians_full] => 97.6867
        [all_lost_int] => 22450
        [all_lost] => 22,450
        [lost_per_believer_int] => 90
        [lost_per_believer] => 90
        [population_growth_status] => Significant Growth
        [deaths_non_christians_next_hour] => 0
        [deaths_non_christians_next_100] => 1
        [deaths_non_christians_next_week] => 3
        [deaths_non_christians_next_month] => 13
        [deaths_non_christians_next_year] => 161
        [births_non_christians_last_hour] => 0
        [births_non_christians_last_100] => 4
        [births_non_christians_last_week] => 8
        [births_non_christians_last_month] => 34
        [births_non_christians_last_year] => 419
        [deaths_christian_adherents_next_hour] => 0
        [deaths_christian_adherents_next_100] => 0
        [deaths_christian_adherents_next_week] => 0
        [deaths_christian_adherents_next_month] => 0
        [deaths_christian_adherents_next_year] => 1
        [births_christian_adherents_last_hour] => 0
        [births_christian_adherents_last_100] => 0
        [births_christian_adherents_last_week] => 0
        [births_christian_adherents_last_month] => 0
        [births_christian_adherents_last_year] => 5
        [favor] => non_christians
        [icon_color] => orange
)

[cities] => Array
(
    [0] => Array
        (
            [id] => 28641
            [geonameid] => 1257771
            [name] => Saiha
            [full_name] => Saiha, Mizoram, India
            [admin0_name] => India
            [latitude] => 22.4918
            [longitude] => 92.9814
            [timezone] => Asia/Kolkata
            [population_int] => 22654
            [population] => 22,654
        )

    )

[people_groups] => Array
(
    [1] => Array
    (
        [id] => 6301
        [name] => Halam Rupini
        [longitude] => 92.7058
        [latitude] => 23.724
        [lg_name] => Aizawl
        [lg_full_name] => Aizawl, Aizawl, Mizoram, India
        [admin0_name] => India
        [admin0_grid_id] => 100219347
        [admin1_grid_id] => 100219370
        [admin2_grid_id] => 100219779
        [admin3_grid_id] => 100221497
        [admin4_grid_id] =>
        [admin5_grid_id] =>
        [population] => 4,500
        [JPScale] => 2
        [LeastReached] => N
        [PrimaryLanguageName] => Kok Borok
        [PrimaryReligion] => Hinduism
        [PercentAdherents] => 44.854
        [PercentEvangelical] => 0
        [PeopleCluster] => South Asia Tribal - other
        [AffinityBloc] => South Asian Peoples
        [PeopleID3] => 19763
        [ROP3] => 115791
        [ROG3] => IN
        [pg_unique_key] => IN_19763_115791
        [query_level] => parent
    )

)

[least_reached] => Array
    (
        [id] => 5939
        [name] => Chakma
        [longitude] => 92.7688
        [latitude] => 23.7962
        [lg_name] => Aizawl
        [lg_full_name] => Aizawl, Aizawl, Mizoram, India
        [admin0_name] => India
        [admin0_grid_id] => 100219347
        [admin1_grid_id] => 100219370
        [admin2_grid_id] => 100219779
        [admin3_grid_id] => 100221497
        [admin4_grid_id] =>
        [admin5_grid_id] =>
        [population] => 217,000
        [JPScale] => 1
        [LeastReached] => Y
        [PrimaryLanguageName] => Chakma
        [PrimaryReligion] => Buddhism
        [PercentAdherents] => 4.914
        [PercentEvangelical] => 0
        [PeopleCluster] => South Asia Tribal - other
        [AffinityBloc] => South Asian Peoples
        [PeopleID3] => 11293
        [ROP3] => 101976
        [ROG3] => IN
        [pg_unique_key] => IN_11293_101976
        [query_level] => parent
    )

)
 */
