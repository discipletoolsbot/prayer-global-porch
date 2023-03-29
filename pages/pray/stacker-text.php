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
        $section_label = 'Prayer Movement';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, we cry out for a prayer movement in the '.$stack['location']['admin_level_name'].' of ' . $stack['location']['full_name'] . '. Please, stir the ' . $stack['location']['believers'] . ' believers here to pray for awakening.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, cause a passion for prayer among the people of ' . $stack['location']['full_name'] . '.',
                'reference' => 'John 17:20-21',
                'verse' => 'I (Jesus) pray also for those who will believe in me through their message, that all of them may be one, Father, just as you are in me and I am in you. May they also be in us so that the world may believe that you have sent me.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, stir the hearts of your people in the '.$stack['location']['admin_level_name'].' of ' . $stack['location']['name'] . ' to agree with you in prayer.',
                'reference' => 'John 17:20-21',
                'verse' => 'I (Jesus) pray also for those who will believe in me through their message, that all of them may be one, Father, just as you are in me and I am in you. May they also be in us so that the world may believe that you have sent me.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, teach the church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to increase their prayer for your kingdom to come.',
                'reference' => 'Daniel 6:10',
                'verse' => 'Now when Daniel learned that the decree had been published, he went home to his upstairs room where the windows opened toward Jerusalem. Three times a day he got down on his knees and prayed, giving thanks to his God...',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, teach the children in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to pray with passion and pleading for your presence.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, awaken a burning desire for your presence and intimacy among the '.$stack['location']['population'].' people living in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord we pray you unite the '.$stack['location']['believers'].' believers to pray at all times in the Spirit, with all prayer and supplication, for spiritual breakthrough in ' . $stack['location']['name'] . '.',
                'reference' => 'Philippians 4:6',
                'verse' => '... in every situation, by prayer and petition, with thanksgiving, present your requests to God.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'God, we pray for the believers in ' . $stack['location']['full_name'] . ' that they will know how to spend an hour in prayer with you.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Please, teach the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].' how to pray to you and how to listen for your voice. That they might follow you into the good works you have prepared for them.',
                'reference' => 'John 10:27',
                'verse' => 'My sheep listen to my voice; I know them, and they follow me.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, answer the requests of your people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => '1 John 5:14',
                'verse' => 'This is the boldness which we have toward him, that, if we ask anything according to his will, he listens to us.',
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_intentional_movement_strategy( &$lists, $stack, $all = false ) {
        $section_label = 'Intentional Multiplicative Strategies';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, you taught Paul to train Timothy to train faithful men who would train others. Please, teach the church of '.$stack['location']['full_name'].' to do that same.',
                'reference' => '2 Timothy 2:2',
                'verse' => 'And the things you have heard me say in the presence of many witnesses entrust to reliable people who will also be qualified to teach others.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, please equip every disciple to make disciples who make disciples in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => '2 Timothy 2:2',
                'verse' => 'And the things you have heard me say in the presence of many witnesses entrust to reliable people who will also be qualified to teach others.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please, raise up a generation of disciples in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' who will make disciples who make disciples.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help the church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to exponentially multiply disciples.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please make every disciple be a disciple maker, every home a training center, and every church a church planting movement in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help the church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' do things that will multiply their numbers, not just add to them.',
                'reference' => '2 Corinthians 2:14',
                'verse' => 'But thanks be to God, who always leads us triumphantly as captives in Christ and through us spreads everywhere the fragrance of the knowledge of Him.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, help the church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to not rely on buildings or programs, but on your Spirit and the simple faithfulness of every believer.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, reveal best practices for sharing the gospel in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
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
        $section_label = 'Movement Health';
        $templates = [
            [
                'section_label' => 'Abundant Gospel Sowing',
                'prayer' => 'Spirit, please give new believers a yearning to see you praised in '.$stack['location']['full_name'].'.',
                'reference' => 'Psalm 96:3',
                'verse' => 'Declare his glory among the nations, his marvelous deeds among all peoples.',
            ],
            [
                'section_label' => 'Abundant Gospel Sowing',
                'prayer' => 'Spirit, give the disciples of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' words, actions, signs and wonders to proclaim the coming of the Kingdom.',
                'reference' => 'Matthew 10:7',
                'verse' => 'As you go, proclaim this message: "The kingdom of heaven has come near."',
            ],
            [
                'section_label' => 'Abundant Gospel Sowing',
                'prayer' => 'Lord, make the ' . $stack['location']['believers'] . ' believers in ' . $stack['location']['name'] . ' to be brave and clear with the gospel to their ' . $stack['location']['all_lost'] . ' neighbors.',
                'reference' => 'Acts 14:3',
                'verse' => 'So Paul and Barnabas spent considerable time there, speaking boldly for the Lord, who confirmed the message of his grace by enabling them to perform signs and wonders.',
            ],
            [
                'section_label' => 'Abundant Gospel Sowing',
                'prayer' => 'Father, we pray the believers are good spiritual stewards of their everyday relationships in ' . $stack['location']['full_name'] . '.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Abundant Gospel Sowing',
                'prayer' => 'Jesus, all authority was given to you, and you commanded all disciples in '. $stack['location']['full_name'] . ' to make more disciples, and you promised to be with them. May your power and their obedience make more disciples today.',
                'reference' => 'Matthew 28:18',
                'verse' => 'All authority in heaven and on earth has been given to me. Therefore go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit, and teaching them to obey everything I have commanded you. And surely I am with you always, to the very end of the age.',
            ],
            [
                'section_label' => 'Abundant Gospel Sowing',
                'prayer' => 'Father, help the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' to be spiritually intentional with their relationships among their '.$stack['location']['all_lost'].' lost friends and neighbors.',
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
        $section_label = 'Person of Peace';
        $templates = [
            [
                'section_label' => 'Person of Peace',
                'prayer' => 'Spirit, help the '.$stack['location']['believers'].' believers find a person of peace today among the '.$stack['location']['all_lost'].' lost neighbors around them. And help them start discovery bible studies in these unbelieving homes.',
                'reference' => 'Acts 10:30-33',
                'verse' => 'Suddenly a man in shining clothes stood before me and said, ‘Cornelius, God has heard your prayer and remembered your gifts to the poor. Send to Joppa for Simon who is called Peter. He is a guest in the home of Simon the tanner, who lives by the sea.’ So I sent for you immediately, and it was good of you to come. Now we are all here in the presence of God to listen to everything the Lord has commanded you to tell us.”',
            ],
            [
                'section_label' => 'Person of Peace',
                'prayer' => 'Father, help your children in '.$stack['location']['full_name'].' find someone like the Samaritan Woman today. Someone who will open an entire town to your message of salvation.',
                'reference' => 'John 4:1–30',
                'verse' => 'So the woman left her water jar and went away into town and said to the people, 29 “Come, see a man who told me all that I ever did. Can this be the Christ?” They went out of the town and were coming to him.',
            ],
            [
                'section_label' => 'Person of Peace',
                'prayer' => 'Father, like with the Ethiopian Eunuch, set up a meeting today between a faithful believer in '.$stack['location']['full_name'].' and a person seeking to understand the truth.',
                'reference' => 'Acts 8:26–40',
                'verse' => 'And the eunuch said to Philip, “About whom, I ask you, does the prophet say this, about himself or about someone else?” Then Philip opened his mouth, and beginning with this Scripture xhe told him the good news about Jesus.',
            ],
            [
                'section_label' => 'Person of Peace',
                'prayer' => 'Father, reveal yourself to a faithful non-believer today, someone like Cornelius, and then Father please connect him with the church in '.$stack['location']['full_name'].'.',
                'reference' => 'Acts 10:9–11:1',
                'verse' => 'And Cornelius said, “Four days ago, about this hour, I was praying in my house ... and behold, a man stood before me in bright clothing and said, "Cornelius, your prayer has been heard and your alms have been remembered before God."',
            ],
            [
                'section_label' => 'Person of Peace',
                'prayer' => 'Spirit, guide someone in the church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to a person ready to receive the message of the gospel, like Lydia, and who will then open her home to faith.',
                'reference' => 'Acts 16:13–15',
                'verse' => 'One of those listening was a woman from the city of Thyatira named Lydia, a dealer in purple cloth. She was a worshiper of God. The Lord opened her heart to respond to Paul’s message.',
            ],
            [
                'section_label' => 'Person of Peace',
                'prayer' => 'Spirit, help the disciples in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to find a person of peace today, like the Phillipian jailor, who heard and was immediately baptized with his whole family.',
                'reference' => 'Acts 16:22–38',
                'verse' => 'And they spoke the word of the Lord to the jailor and to all who were in his house. And the jailor took them the same hour of the night and washed their wounds; and he was baptized at once, he and all his family.',
            ],
            [
                'section_label' => 'Person of Peace',
                'prayer' => 'Jesus, like with the centurion who came to you for his sick servant, please call into you house those who have great faith but are not yet yours in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'] . '.',
                'reference' => 'Luke 7:1–10',
                'verse' => 'When Jesus heard these things, he marveled at (the centurion), and turning to the crowd that followed him, said, “I tell you, not even in Israel have I found such faith.” And when those who had been sent returned to the house, they found the servant well.',
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
        $section_label = 'Priesthood of Believers';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, guide the church in '.$stack['location']['full_name'].' to see their community as a holy priesthood, offering spiritual sacrifices acceptable to God.',
                'reference' => '1 Peter 2:4-5',
                'verse' => 'you also, like living stones, are being built into a spiritual house to be a holy priesthood, offering spiritual sacrifices acceptable to God through Jesus Christ.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, thank you that in your kindness you have made every believer in '.$stack['location']['full_name'].' a priest, who can offer spiritual sacrifices to you through Jesus.',
                'reference' => 'Matthew 5:43-44',
                'verse' => 'Therefore I tell you that the kingdom of God will be taken away from you and given to a people who will produce its fruit. He who falls on this stone will be broken to pieces, but he on whom it falls will be crushed.”',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, please convict each believer in '.$stack['location']['full_name'].' to take up their calling as a priesthood of believers and pray for the '.$stack['location']['all_lost'].' lost around them.',
                'reference' => '1 Peter 2:4-5',
                'verse' => 'you also, like living stones, are being built into a spiritual house to be a holy priesthood',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please raise up every one you have called in '.$stack['location']['full_name'].' to become worthy of their calling, and offer spiritual sacrifices acceptable to you through Jesus.',
                'reference' => 'Ephesians 4:1',
                'verse' => 'I urge you to live a life worthy of the calling you have received',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, please convict the believers in '.$stack['location']['full_name'].' to not assume the ministry is for professional clergy, but for all who have been called by you.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, encourage the '.$stack['location']['believers'].' believers to have boldness before you, since they have a great high priest who has passed through the heavens, Jesus the Son of God.',
                'reference' => 'Hebrews 4:14-16',
                'verse' => 'Since then we have a great high priest who has passed through the heavens, Jesus, the Son of God, let us hold fast our confession.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, your are the great high priest, please make the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].' a worthy priesthood under you.',
                'reference' => 'Hebrews 4:14-16',
                'verse' => 'Since then we have a great high priest who has passed through the heavens, Jesus, the Son of God, let us hold fast our confession.',
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
        $section_label = 'Unleashing Simple Churches';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'God, guide the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' to multiply spiritual families that love you, love each other, and make disciples.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' to start simple multiplying churches in their homes.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, we pray that the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' be filled with simple churches in every neighborhood.',
                'reference' => 'Isaiah 11:9',
                'verse' => 'For the earth will be full of the knowledge of the Lord, as the waters cover the sea.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, we ask for '.$stack['location']['new_churches_needed'].' new simple churches in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'. Place a simple church in every community of the '.$stack['location']['population'].' people living here.',
                'reference' => 'Psalm 72:19',
                'verse' => 'And blessed be His glorious name forever; And may the whole earth be filled with His glory. Amen, and Amen.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, teach the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' the wisdom of how to form simple, reproducible churches of 12-30 in every neighborhood.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, bless the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' with a multiplying movement of house churches.',
                'reference' => 'Numbers 14:21',
                'verse' => '...but indeed, as I live, all the earth will be filled with the glory of the Lord.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'God, we pray both the men and women of ' . $stack['location']['full_name'] . ' will find ways to meet in groups of two or three to encourage and correct one another from your Word.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'The Church',
                'prayer' => 'Father, multiply brothers, sisters, and mothers to our spiritual family in '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 12:50',
                'verse' => 'He replied to him, “Who is my mother, and who are my brothers?” Pointing to his disciples, he said, “Here are my mother and my brothers. For whoever does the will of my Father in heaven is my brother and sister and mother.”',
            ],
            [
                'section_label' => 'The Church',
                'prayer' => 'Father, we rejoice that you who began a good work in the church of ' . $stack['location']['full_name'] . ' will carry it on to completion until the day of Jesus Christ!',
                'reference' => 'Philippians 1:6',
                'verse' => '...being confident of this, that he who began a good work in you will carry it on to completion until the day of Christ Jesus.',
            ],
            [
                'section_label' => 'The Church',
                'prayer' => 'Father, remind your church in ' . $stack['location']['full_name'] . ' that you have set your Son over all rule and authority, power and dominion, and every name that is invoked.',
                'reference' => 'Ephesians 1:21',
                'verse' => '...he raised Christ from the dead and seated him at his right hand in the heavenly realms, far above all rule and authority, power and dominion, and every name that is invoked, not only in the present age but also in the one to come.',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Father, help '.$stack['location']['new_churches_needed'].' new simple churches start among the '.$stack['location']['population'].' people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'. One within reach of everyone living here.',
                'reference' => 'Habakkuk 2:14',
                'verse' => 'For the earth will be filled with the knowledge of the glory of the Lord as the waters cover the sea.',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Spirit, please start new house churches in every neighborhood of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Habakkuk 2:14',
                'verse' => 'For the earth will be filled with the knowledge of the glory of the Lord as the waters cover the sea.',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Spirit, please give every church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' a passion to plant another simple church.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Father, show your mercy on the '.$stack['location']['all_lost'].' people in '.$stack['location']['name'].' who are far from you. Please add '.$stack['location']['new_churches_needed'].' new house churches this year.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Father, we agree with your desire that the people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' hear about you.',
                'reference' => 'Romans 15:21',
                'verse' => 'Those who were not told about him will see, and those who have not heard will understand.',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Father, let every disciple be a disciple maker, every home a training center, and every church a church planting movement in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Father, we ask for networks of simple churches in every city in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].', like Paul planted in Corinth and Ephesus.',
                'reference' => '1 Corinthians 16:19',
                'verse' => 'The churches in the province of Asia send you greetings. Aquila and Priscilla greet you warmly in the Lord, and so does the church that meets at their house.',
            ],
            [
                'section_label' => 'Church Planting',
                'prayer' => 'Jesus, '.$stack['location']['population'].' people live in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'. Please, give them '.$stack['location']['new_churches_needed'].' new simple churches this year.',
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
        $section_label = 'Bible Access';
        $templates = [];

        // focus for non christians is exposure to the Word of God and access to a bible
        $templates['non_christians'] = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please give the people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' access to a Bible in their own language.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, how will they hear without a preacher? How will they preach unless they have a Bible? Please give the people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' access to a Bible in their own language.',
                'reference' => 'Romans 10:14-15',
                'verse' => 'How, then, can they call on the one they have not believed in? And how can they believe in the one of whom they have not heard? And how can they hear without someone preaching to them? And how can anyone preach unless they are sent? As it is written: “How beautiful are the feet of those who bring good news!”',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please remove the barriers that keep the '.$stack['location']['non_christians'].' who are far from you in '.$stack['location']['full_name'].' from having access to a Bible.',
                'reference' => 'Matthew 24:14',
                'verse' => 'And this gospel of the kingdom will be preached in the whole world as a testimony to all nations, and then the end will come.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, put your Bible in the hands of the '.$stack['location']['non_christians'].', who are far from you and live in this place.',
                'reference' => 'Psalm 119:9-10',
                'verse' => 'How can a young person stay on the path of purity? By living according to your word. I seek you with all my heart; do not let me stray from your commands.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, it’s possible most of the '.$stack['location']['non_christians'].' lost people in  '.$stack['location']['full_name'].' have never held or opened a Bible. Please change this, Father.',
                'reference' => 'Romans 10:17',
                'verse' => 'Yet faith comes from listening to this Good News—the Good News about Christ.',
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
                'prayer' => 'Lord, there are '.$stack['location']['christian_adherents'].' people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' who claim Christianity, but may have never read the Bible. Please challenge them today to read the Bible for themselves.',
                'reference' => '2 Timothy 3:16-17',
                'verse' => 'All scripture is given by inspiration of God, and is profitable for doctrine, for reproof, for correction, for instruction in righteousness.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, of the '.$stack['location']['christian_adherents'].' people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' who claim Christianity, challenge some of them to pickup your Word and read it for themselves today.',
                'reference' => 'John 8:32',
                'verse' => 'and you will know the truth, and the truth will set you free.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, your Word is essential for life and growth. Please challenge the '.$stack['location']['christian_adherents'].' cultural Christians in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to read your Word for themselves today.',
                'reference' => 'Matthew 4:4',
                'verse' => 'Man shall not live by bread alone, but by every word that comes from the mouth of God.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' will disappear one day, but your Word will never disappear. Call all who claim Christianity to anchor their lives on your Word.',
                'reference' => 'Matthew 24:35',
                'verse' => 'Heaven and earth will disappear, but my words will never disappear.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, your word can be a lamp to the feet of the '.$stack['location']['christian_adherents'].' people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' who claim to know you, if they open it an read it today.',
                'reference' => 'Psalm 119:105',
                'verse' => 'your word is a lamp to my feet and a light to my path.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, make the '.$stack['location']['christian_adherents'].' people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' who claim to know you, brave enough to let the Bible weigh their thoughts and intentions today.',
                'reference' => 'Hebrews 4:12',
                'verse' => 'For the word of God is living and powerful, and sharper than any two-edged sword, piercing even to the division of soul and spirit, and of joints and marrow, and is a discerner of the thoughts and intents of the heart.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help get online Bibles and Bible apps onto the phones of the '.$stack['location']['christian_adherents'].' people who claim to know you, so they can read everyday.',
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
                'prayer' => 'Father, please provide access to your Word for everyone, especially believers in '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 24:14',
                'verse' => 'And this gospel of the kingdom will be preached in the whole world as a testimony to all nations, and then the end will come.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, if there is even one of the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].' who does not have a Bible, please provide them one today.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, let your Word be a lamp to the feet of the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].'.',
                'reference' => 'Psalm 119:105',
                'verse' => 'your word is a lamp to my feet and a light to my path.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].' desire the Bible as newborn babies desire milk.',
                'reference' => '1 Peter 2:2-3',
                'verse' => 'Desire God’s pure word as newborn babies desire milk. Then you will grow in your salvation.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, provide a good translation of the Bible for the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].'.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, provide a Bible for every believer in '.$stack['location']['full_name'].', and teach them to obey it.',
                'reference' => 'James 1:23-25',
                'verse' => 'For if you listen to the word and don’t obey, it is like glancing at your face in a mirror. 24 you see yourself, walk away, and forget what you look like. 25 But if you look carefully into the perfect law that sets you free, and if you do what it says and don’t forget what you heard, then God will bless you for doing it.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, inspire Bible translators to communicate the Scriptures accurately in the heart languages spoken in '.$stack['location']['full_name'].'.',
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
        $section_label = 'Media';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please help good, online teachers get the gospel on Youtube and into '.$stack['location']['admin_level_name'].' of '. $stack['location']['admin_level_name'].'.',
                'reference' => 'Matthew 24:14',
                'verse' => 'And this gospel of the kingdom will be preached in the whole world as a testimony to all nations, and then the end will come.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, guide seekers in '.$stack['location']['full_name'].' to the gospel through searching Youtube or Tiktok today.',
                'reference' => 'Proverbs 8:17',
                'verse' => 'I love those who love me, and those who diligently seek me will find me.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, help media producers communicate the gospel in a way that is understandable to the people of '.$stack['location']['full_name'].'.',
                'reference' => 'Deuteronomy 4:29',
                'verse' => 'But from there, you will seek the LORD your God, and you will find Him if you search for Him with all your heart and all your soul.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, as people seek answers on the internet, please help them find the gospel in '.$stack['location']['full_name'].'.',
                'reference' => 'Luke 11:9-10',
                'verse' => 'So I say to you, ask, and it will be given to you; seek, and you will find; knock, and it will be opened to you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, guide every search on Google for truth in '.$stack['location']['full_name'].' to find a gospel video.',
                'reference' => 'Jeremiah 29:13',
                'verse' => 'you will seek Me and find Me when you search for Me with all your heart.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, use Google search to lead people in '.$stack['location']['full_name'].' to the gospel today.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, supernaturally prepare encounters with the gospel on sites like Facebook and Instagram for the '.$stack['location']['population'].' people living in '.$stack['location']['name'].'.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, inspire new kinds of evangelism through social media in '.$stack['location']['full_name'].'.',
                'reference' => '2 Timothy 4:5',
                'verse' => 'But you, keep your head in all situations, endure hardship, do the work of an evangelist, discharge all the duties of your ministry.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, make yourself known to the '.$stack['location']['population'].' people living in '.$stack['location']['name'].' through the internet today.',
                'reference' => 'Psalm 19:4',
                'verse' => 'They have no speech, they use no words; no sound is heard from them. Yet their voice goes out into all the earth, their words to the ends of the world. In the heavens God has pitched a tent for the sun.',
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
        $section_label = 'Safety';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, for those in trouble in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' prompt them to call on you for rescue today.',
                'reference' => 'Psalm 91:15',
                'verse' => 'He will call on me, and I will answer him. I will be with him in trouble. I will deliver him, and honor him.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, for those with enemies and who are afraid in '.$stack['location']['name'].', call them into your shelter and safety today.',
                'reference' => 'Psalm 61:3',
                'verse' => 'For you have been a refuge for me, a strong tower from the enemy.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, be a refuge and strength for the hurting in '.$stack['location']['full_name'].' today.',
                'reference' => 'Psalm 46:1',
                'verse' => 'God is our refuge and strength, an ever-present help in trouble.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, help the stressed and anxious in '.$stack['location']['full_name'].' know that you care for them today.',
                'reference' => 'Psalm 55:22',
                'verse' => 'Cast your cares on the Lord and he will sustain you; he will never let the righteous be shaken.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, teach those feeling unsafe in '.$stack['location']['full_name'].' that they can hide under your wings',
                'reference' => 'Psalm 91:4',
                'verse' => 'He will cover you with his feathers, and under his wings you will find refuge; his faithfulness will be your shield and rampart.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, protect the vulnerable in '.$stack['location']['full_name'].' from the evil one.',
                'reference' => 'John 17:15',
                'verse' => 'My prayer is not that you take them out of the world but that you protect them from the evil one.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, let the threatened of '.$stack['location']['full_name'].' know that is better to trust in you than to trust in humans.',
                'reference' => 'Psalm 118:8',
                'verse' => 'It is better to take refuge in the Lord than to trust in humans.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help the fearful in '.$stack['location']['full_name'].' to submit to God and resist the devil.',
                'reference' => 'James 4:7',
                'verse' => 'Submit yourselves, then, to God. Resist the devil, and he will flee from you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, encourage those who are afraid in '.$stack['location']['full_name'].' that you are the healer and you are the savior.',
                'reference' => 'Jeremiah 17:14',
                'verse' => 'Heal me, Lord, and I will be healed; save me and I will be saved, for you are the one I praise.',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Psalm 145:18-20',
//                'verse' => 'The Lord is near to all who call on him, to all who call on him in truth. He fulfills the desires of those who fear him; he hears their cry and saves them.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Psalms 107:13-14',
//                'verse' => 'Then they cried to the Lord in their trouble, and he saved them from their distress. He brought them out of darkness, the utter darkness, and broke away their chains.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Psalm 34:10',
//                'verse' => 'The lions may grow weak and hungry, but those who seek the Lord lack no good thing.',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_political_stability( &$lists, $stack, $all = false ) {
        $section_label = 'Political Stability';
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Proverbs 28:5',
//                'verse' => 'Evil men do not understand justice, But those who seek the LORD understand all things.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Proverbs 2:3-6',
//                'verse' => 'Indeed, if you call out for insight and cry aloud for understanding, and if you look for it as for silver and search for it as for hidden treasure, then you will understand the fear of the Lord and find the knowledge of God. For the Lord gives wisdom; from his mouth come knowledge and understanding.',
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
        $section_label = 'Population';
        $templates = [
            [
                'section_label' => 'Far from God',
                'prayer' => 'Father, you desire the people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' who are far from you to hear about you.',
                'reference' => 'Romans 15:21',
                'verse' => 'Those who were not told about him will see, and those who have not heard will understand.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'There are '.$stack['location']['population'].' people living in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'. Only about '.$stack['location']['believers'].' might be believers.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'The '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' has (about) '.$stack['location']['believers'].' people who know Jesus, '.$stack['location']['christian_adherents'].' people who know about him culturally, and '.$stack['location']['non_christians'].' people who are far from Jesus.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Pour your Spirit out on the '.$stack['location']['population'].' citizens of '.$stack['location']['full_name'].', so that they might know your name and the name of your Son.',
                'reference' => 'Joel 2:28',
                'verse' => 'And afterward, I will pour out my Spirit on all people. your sons and daughters will prophesy, your old men will dream dreams, your young men will see visions.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, we suspect there is 1 believer for every '.$stack['location']['lost_per_believer'] . ' neighbors who are far from you in '.$stack['location']['name'].'. Please, give courage and opportunity to your children to speak boldly.',
                'reference' => 'Ephesians 6:19',
                'verse' => 'Pray also for me, that whenever I speak, words may be given me so that I will fearlessly make known the mystery of the gospel.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, help the people of ' . $stack['location']['full_name'] . ' to discover the essence of being a disciple, making disciples, and how to plant churches that multiply.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, you know every soul, and you know who are yours and who are yet to be yours out of the '.$stack['location']['population'] .' people living in '. $stack['location']['full_name'] . '. Please, call your lost sheep to yourself.',
                'reference' => 'Ezekiel 36:24',
                'verse' => 'For I will take you out of the nations; I will gather you from all the countries and bring you back into your own land.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, bring yourself glory in '.$stack['location']['name'].'. Through your servants plant '.$stack['location']['new_churches_needed'].' new churches that love you, love one another, and make disciples this year.',
                'reference' => 'Habakkuk 2:14',
                'verse' => 'For the earth will be filled with the knowledge of the glory of the LORD as the waters cover the sea.',
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
        $section_label = 'Non-Christians';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Over '.$stack['location']['percent_non_christians'].' percent of the people of '.$stack['location']['name'].' are far from Jesus. Lord, please send your gospel to them through the internet or radio or television today!',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Over '.$stack['location']['percent_non_christians'].' percent of the people of '.$stack['location']['name'].' are far from Jesus.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, call those who are far off in '.$stack['location']['full_name'].', so that they and their family can receive life.',
                'reference' => 'Acts 2:39',
                'verse' => 'For the promise is to you, and to your children, and to all who are far off, even as many as the Lord our God will call to himself.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, you said, "The earth belongs to Me and all that is in it". Please, call '.$stack['location']['full_name'].' into obedience and eternal life.',
                'reference' => 'Psalm 24:1',
                'verse' => 'The earth is Yahweh’s, with its fullness; the world, and those who dwell therein.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, let it be said of the '.$stack['location']['all_lost'].' lost in '.$stack['location']['name'].' that you have called them out of darkness into your glorious light.',
                'reference' => '1 Peter 2:9',
                'verse' => 'But you are a chosen race, a royal priesthood, a holy nation, a people for God’s own possession, that you may proclaim the excellence of him who called you out of darkness into his marvelous light',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, please make the same Spirit that raised Jesus from the dead give life to those are called by his name in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Romans 8:11',
                'verse' => 'But if the Spirit of him who raised up Jesus from the dead dwells in you, he who raised up Christ Jesus from the dead will also give life to your mortal bodies through his Spirit who dwells in you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, you desire to blot out the sins of the people of '.$stack['location']['full_name'].'. you said, if they turn to you, you will dissolve their sins like mist.',
                'reference' => 'Isaiah 44:22',
                'verse' => 'I have blotted out, as a thick cloud, your transgressions, and, as a cloud, your sins. Return to me, for I have redeemed you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, please send your Spirit to '.$stack['location']['name'].', so they can have freedom.',
                'reference' => '2 Corinthians 3:17',
                'verse' => 'Now the Lord is the Spirit and where the Spirit of the Lord is, there is freedom.',
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
        $section_label = 'Cultural Christians';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => "Spirit, ".$stack['location']['christian_adherents']." cultural Christians in ".$stack['location']['full_name']." likely have a Bible in their home. Please, send conviction for them to open it and read it for themselves.",
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => "Spirit, teach the ".$stack['location']['christian_adherents']." cultural Christians in ".$stack['location']['full_name']." to pray from the heart and not with scripts or formulas only.",
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => "Spirit, bless the ".$stack['location']['christian_adherents']." cultural Christians in ".$stack['location']['name']." with more knowledge and curiosity about your beautiful gospel, that they might claim it for themselves personally and intimately.",
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
        $section_label = 'Believer Families';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, thank you for the '.$stack['location']['believers'].' whom you have brought close through the blood of Christ already in '.$stack['location']['full_name'].'.',
                'reference' => 'Ephesians 2:13',
                'verse' => 'But now in Christ Jesus you who once were far off are made near in the blood of Christ.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, thank you for the '.$stack['location']['believers'].' people that you have made believe and given eternal life to in '.$stack['location']['full_name'].'.',
                'reference' => 'John 3:16',
                'verse' => 'For God so loved the world, that he gave his only Son, that whoever believes in him should not perish but have eternal life.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, you made each of the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].' your ambassadors and your primary strategy for reconciling this '.$stack['location']['admin_level_name'].' .',
                'reference' => '2 Corinthians 5:20',
                'verse' => 'We are therefore Christ’s ambassadors, as though God were making his appeal through us. We implore you on Christ’s behalf: Be reconciled to God.',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '2 Chronicles 16:9',
//                'verse' => 'For the eyes of the LORD range throughout the earth to strengthen those whose hearts are fully committed to him.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '1 Chronicles 16:11',
//                'verse' => 'Seek the LORD and His strength; Seek His face continually.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Psalm 105:3-4',
//                'verse' => 'Glory in his holy name; let the hearts of those who seek the Lord rejoice. Look to the Lord and his strength; seek his face always.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '1 Chronicles 16:1-11',
//                'verse' => 'Let the heart of those who seek the Lord be glad. Seek the Lord and his strength; seek his presence continually.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Psalm 34:5',
//                'verse' => 'Those who look to him are radiant; their faces are never covered with shame.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => '2 Timothy 2:15',
//                'verse' => 'Do your best to present yourself to God as one approved, a worker who does not need to be ashamed and who correctly handles the word of truth.',
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

        $section_label = 'Primary Religion';
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => 'The primary religion in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].' is '.$stack['location']['primary_religion'].'.',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Father, give the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' the skill to communicate your gospel to those who follow '.$stack['location']['primary_religion'].' around them.',
//                'reference' => 'Ephesians 6:19',
//                'verse' => 'Pray also for me, that whenever I speak, words may be given me so that I will fearlessly make known the mystery of the gospel.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Father, many people in '.$stack['location']['full_name'].' follow '.$stack['location']['primary_religion'].'. Please give them accurate knowledge of Jesus.',
//                'reference' => 'Romans 10:2',
//                'verse' => 'For I can testify about them that they are zealous for God, but their zeal is not based on knowledge.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Lord, increase spiritual dissatisfaction among those in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' who follow '.$stack['location']['primary_religion'] . ', so that they would begin to seek you.',
//                'reference' => 'Romans 10:2',
//                'verse' => 'For I can testify about them that they are zealous for God, but their zeal is not based on knowledge.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Even though the primary religion is '.$stack['location']['primary_religion'] . ' in '.$stack['location']['name'].', Lord, call to yourself persons of peace among the community...those who fear you with the best knowledge they have.',
//                'reference' => 'Acts 10:1,2',
//                'verse' => 'At Caesarea there was a man named Cornelius, a centurion in what was known as the Italian Regiment. He and all his family were devout and God-fearing; he gave generously to those in need and prayed to God regularly.',
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

        $section_label = 'Language';
        $templates = [
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Father, please provide access to your written Word in the ' . $stack['location']['primary_language'] . ' language.',
//                'reference' => 'Isaiah 55:11',
//                'verse' => 'So will My word be which goes forth from My mouth; It will not return to Me empty, Without accomplishing what I desire, And without succeeding in the matter for which I sent it.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Father, please send those who can create videos and podcasts for the ' . $stack['location']['primary_language'] . ' language for the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Father, please provide digital and printed Bibles in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' specifically in the ' . $stack['location']['primary_language'] . ' language. Give success to those who distribute them.',
//                'reference' => 'Isaiah 55:11',
//                'verse' => 'So will My word be which goes forth from My mouth; It will not return to Me empty, Without accomplishing what I desire, And without succeeding in the matter for which I sent it.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Father, please provide a translation of the Bible in the ' . $stack['location']['primary_language'] . ' language to every seeker in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Spirit, please, send the truth about Jesus through youTube, Tiktok, and Instagram in the ' . $stack['location']['primary_language'] . ' language for the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
//                'reference' => '',
//                'verse' => '',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => 'Lord, raise up workers in the ' . $stack['location']['primary_language'] . ' language, who can communicate accurately the Word of truth.',
//                'reference' => '2 Timothy 2:15',
//                'verse' => '...a worker who does not need to be ashamed and who correctly handles the word of truth.',
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
        $section_label = 'Prayer Movement';
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
        $section_label = 'Prayer Movement';
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
        $section_label = 'Prayer Movement';
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
        $section_label = 'People Groups';
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
        $section_label = 'Local Leadership';
        $templates = [
            [
                'section_label' => 'Local Leadership',
                'prayer' => 'Spirit, build the strength and maturity of the local leaders in '.$stack['location']['full_name'].'. Show them that faithfulness is better than knowledge. Show them that the Spirit, the Word, and prayer is enough in order to grow and lead.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Local Leadership',
                'prayer' => 'God, we ask you to raise up elders and deacons from the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].', who will serve the church and equip it to do your work.',
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up until we all reach unity in the faith and in the knowledge of the Son of God and become mature, attaining to the whole measure of the fullness of Christ.',
            ],
            [
                'section_label' => 'Movement Leadership',
                'prayer' => 'Father, we pray for every movement leader and disciple in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].' that they would have deepening intimacy with you.',
                'reference' => 'John 14:20',
                'verse' => 'On that day you will realize that I am in my Father, and you are in me, and I am in you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, grace the churches in '.$stack['location']['full_name'].' with faithful local leaders.',
                'reference' => 'Proverbs 11:14',
                'verse' => 'Where there is no guidance, a people falls, but in an abundance of counselors there is safety.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, teach the local leaders in '.$stack['location']['full_name'].' to be humble and to serve others.',
                'reference' => 'Matthew 20:26–28',
                'verse' => 'It shall not be so among you. But whoever would be great among you must be your servant, and whoever would be first among you must be your slave, even as the Son of Man came not to be served but to serve, and to give his life as a ransom for many.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, help the local leaders in '.$stack['location']['full_name'].' to be faithful with what they have been given, whether a little or a lot.',
                'reference' => 'Luke 12:48',
                'verse' => 'Everyone to whom much was given, of him much will be required, and from him to whom they entrusted much, they will demand the more.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, help the local leaders in '.$stack['location']['full_name'].' not be proud but humble, and willing to wash the feet of all they serve.',
                'reference' => 'John 13:13–17',
                'verse' => 'you call me Teacher and Lord, and you are right, for so I am. If I then, your Lord and Teacher, have washed your feet, you also ought to wash one another’s feet. For I have given you an example, that you also should do just as I have done to you. ',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, may the churches in '.$stack['location']['full_name'].' honor local leaders who work hard for the flock of God.',
                'reference' => 'Acts 20:28',
                'verse' => 'Pay careful attention to yourselves and to all the flock, in which the Holy Spirit has made you overseers, to care for the church of God, which he obtained with his own blood.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, knowing that teachers will be judged more strictly, help the local leaders in '.$stack['location']['full_name'].' to be careful with their words.',
                'reference' => 'James 3:1',
                'verse' => 'Not many of you should become teachers, my brothers, for you know that we who teach will be judged with greater strictness.',
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
        $section_label = 'Apostles and Pioneers';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please raise up new apostles to pioneer the growth of the church in '.$stack['location']['name'],
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, raise up apostolic workers to plant churches in every town in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Titus 1:5',
                'verse' => 'The reason I left you in Crete was that you might put in order what was left unfinished and appoint elders in every town, as I directed you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please send new apostles into the harvest, who can open up new communities for the gospel in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 9:38',
                'verse' => 'Ask the Lord of the harvest, therefore, to send out workers into his harvest field.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, please give the apostles in '.$stack['location']['full_name'].' a vision for the harvest, and a passion to see the gospel spread to every corner of the '.$stack['location']['admin_level_name'].'.',
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord of the Harvest, please send out workers into the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 9:37-38',
                'verse' => 'Then he said to his disciples, “The harvest is plentiful but the workers are few. Ask the Lord of the harvest, therefore, to send out workers into his harvest field.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, please give apostles to expand the church into every neighborhood of '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 28:19-20',
                'verse' => 'Therefore go and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit, and teaching them to obey everything I have commanded you.',
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
        $section_label = 'Evangelists and Harvest Workers';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, please raise up evangelists to equip your people to share the gospel in '.$stack['location']['name'].'.',
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please send new evangelists into the harvest in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 9:38',
                'verse' => 'Ask the Lord of the harvest, therefore, to send out workers into his harvest field.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, you said you were the giver of evangelists to the church. Please, send more evangelists to the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.',
            ],
            [
                'section_label' => 'Evangelists',
                'prayer' => 'God in Heaven, only you can and should appoint evangelists. Please, appoint and send more to '.$stack['location']['full_name'].'.',
                'reference' => '1 Corinthians 12:28',
                'verse' => 'And in the church God has appointed first of all apostles, second prophets, third teachers, then workers of miracles, and those with gifts of healing, helping, administration, and various tongues.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, encourage every believer in '.$stack['location']['full_name'].' to do the work of an evangelist with their friends and neighbors.',
                'reference' => 'Ephesians 4:5',
                'verse' => 'But you, keep your head in all situations, endure hardship, do the work of an evangelist ...',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help every believers in '.$stack['location']['full_name'].' be prepared to give an answer to everyone who asks them for the reason for their hope.',
                'reference' => '1 Peter 3:15',
                'verse' => 'But in your hearts revere Christ as Lord. Always be prepared to give an answer to everyone who asks you to give the reason for the hope that you have. But do this with gentleness and respect,',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, send out evangelists who will challenge people like Peter who said, "Repent and be baptized, every one of you" in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => 'Acts 2:38',
                'verse' => 'Peter replied, “Repent and be baptized, every one of you, in the name of Jesus Christ for the forgiveness of your sins. And you will receive the gift of the Holy Spirit.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, please give your people in '.$stack['location']['full_name'].' a passion for the lost.',
                'reference' => '2 Corinthians 5:20',
                'verse' => 'We are therefore Christ’s ambassadors, as though God were making his appeal through us. We implore you on Christ’s behalf: Be reconciled to God.',
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
        $section_label = 'Prophets and Truth Speakers';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please raise up prophets in '.$stack['location']['name'].' who can call the church to holiness and purity, preparing your church as a bride for your Son.',
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please give the church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' prophets who can build up holiness and faithfulness to you.',
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, you already know the names of the prophets you want to raise up in '.$stack['location']['name'].'. Please, raise them up and give them the courage to speak your truth to your church.',
                'reference' => 'Jeremiah 1:5',
                'verse' => 'Before I formed you in the womb I knew you, and before you were born I consecrated you; I appointed you a prophet to the nations.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, like in the church of Antioch, where you gathered many prophets and teachers, please gather many prophets and teachers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => 'Acts 13:1',
                'verse' => 'Now in the church at Antioch there were prophets and teachers: Barnabas, Simeon called Niger, Lucius of Cyrene, Manaen (who had been brought up with Herod the tetrarch), and Saul.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, make bold the prophets in '.$stack['location']['full_name'].' so that the church can be equipped with truth and insight and a vision of your heart.',
                'reference' => 'Zechariah 8:16',
                'verse' => 'These are the things which you should do: speak the truth to one another; judge with truth and judgment for peace in your gates.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, raise up prophets and truth speakers in your church in '.$stack['location']['full_name'].' so that the church can grow up in all aspects into you its head.',
                'reference' => 'Ephesians 4:15',
                'verse' => 'but speaking the truth in love, we are to grow up in all aspects into Him who is the head, even Christ.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, make the church in '.$stack['location']['full_name'].' humble and willing to hear the sometimes hard voices of prophets bringing the light of truth on them.',
                'reference' => 'Galatians 4:16',
                'verse' => 'So have I become your enemy by telling you the truth?',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, strengthen the church in '.$stack['location']['full_name'].' by giving a prophet, as you said you would, who is bold and willing to correct. Lord, may the believers care about holiness as you do.',
                'reference' => 'Ephesians 4:11',
                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Ephesians 4:11',
//                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Ephesians 4:11',
//                'verse' => 'So Christ himself gave the apostles, the prophets, the evangelists, the pastors and teachers, to equip his people for works of service, so that the body of Christ may be built up.',
//            ],

        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_shepherding_leadership( &$lists, $stack, $all = false ) {
        $section_label = 'Shepherds and Pastors';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, give grace to the local leaders who shepherd the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'John 10:11',
                'verse' => 'I am the good shepherd. The good shepherd lays down his life for the sheep.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, please provide elders whose heart is completely yours in every town in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Titus 1:5',
                'verse' => 'The reason I left you in Crete was that you might put in order what was left unfinished and appoint elders in every town, as I directed you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, please bless the leaders of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].' who work hard at shepherding and guiding your people.',
                'reference' => 'Psalm 78:72',
                'verse' => 'With upright heart he shepherded them and guided them with his skillful hand.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, encourage every one of the '.$stack['location']['believers'].' ordinary believers here to care for others, like a shepherd cares for his sheep.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, you gave the church of '.$stack['location']['full_name'].' the greatest shepherd of all time, Jesus. Please, help them listen to him.',
                'reference' => 'Ezekiel 34:23',
                'verse' => 'I will place over them one shepherd, my servant David, and he will tend them; he will tend them and be their shepherd.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, for all those you call to look after your flock from the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].', please, make them passionate about hearing your Word.',
                'reference' => 'Ezekiel 34:7',
                'verse' => 'Therefore, you shepherds, hear the word of the LORD.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Good Shepherd, thank you that you know the name of each of the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].'.',
                'reference' => 'John 10:14',
                'verse' => 'I am the good shepherd; I know my sheep and my sheep know me',
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
        $section_label = 'Teachers';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please send teachers of your Word in '.$stack['location']['name'].' who can speak your gospel boldly and clearly.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, build the strength and maturity of the local leaders in '.$stack['location']['full_name'].'. Show them that faithfulness is more important than knowledge. Show them that the Spirit, the Word, and prayer is enough in order to grow and lead. ',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, for the leaders in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].', let the eyes of their hearts be enlightened in order that they may know the hope to which they are called.',
                'reference' => 'Ephesians 1:18',
                'verse' => 'I pray that the eyes of your heart may be enlightened in order that you may know the hope to which he has called you, the riches of his glorious inheritance in his holy people, and his incomparably great power for us who believe. ',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please send new teachers into the harvest, who can correct the lies of our enemy in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 9:38',
                'verse' => 'Ask the Lord of the harvest, therefore, to send out workers into his harvest field.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, the believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['full_name'].' need teachers who can feed them with knowledge and understanding. Please raise them up.',
                'reference' => 'Jeremiah 3:15',
                'verse' => 'Then I will give you shepherds after My own heart, who will feed you with knowledge and understanding.',
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
        $section_label = 'Biblical Authority';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, make the Word of God a delight to the people of '.$stack['location']['name'].', like it was to David.',
                'reference' => 'Psalm 119:16',
                'verse' => 'I delight in your decrees, I will not neglect your word.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, instill a desire within the people of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to hide your word in their heart.',
                'reference' => 'Psalm 119:11',
                'verse' => 'I have hidden your word in my heart that I might not sin against you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, help the people of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to be consumed with longing for your Word at all times, like David.',
                'reference' => 'Psalm 119:20',
                'verse' => 'My soul is consumed with longing for your laws at all times.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, teach your Word to the people of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].', so that they can follow your ways all their life.',
                'reference' => 'Psalm 119:33',
                'verse' => 'Teach me, Lord, the way of your decrees, that I may follow it to the end.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, teach the disciples in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to trust your Word, like a lamp, in the darkness around them.',
                'reference' => 'Psalm 119:105',
                'verse' => 'your word is a lamp for my feet, a light on my path.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, teach the young people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to trust your Word and find the path of purity.',
                'reference' => 'Psalm 119:9',
                'verse' => 'How can a young person stay on the path of purity? By living according to your word.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, we know that cultures come and go, even in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].', but the truth of your Word endures generations.',
                'reference' => 'Psalm 119:89',
                'verse' => 'your word, Lord, is eternal; it stands firm in the heavens.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, defend those who are loyal to your Word in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].', even against fierce enemies.',
                'reference' => 'Psalm 119:61',
                'verse' => 'Though the wicked bind me with ropes, I will not forget your law.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, fill the '.$stack['location']['population'].' souls living in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' with a taste for your Word. Make it sweet as honey in their mouth.',
                'reference' => 'Psalm 119:103',
                'verse' => 'How sweet are your words to my taste, sweeter than honey to my mouth!',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, fill the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' with tears, because God is not obeyed by those around them.',
                'reference' => 'Psalm 119:136',
                'verse' => 'Streams of tears flow from my eyes, for your law is not obeyed.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, guide the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' into all truth as they interpret Scriptures.',
                'reference' => 'Hebrews 4:12',
                'verse' => 'For the Word of God is alive and active. Sharper than any two-edged sword, it penetrates even to dividing soul and spirit, joints and marrow.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, we pray that the people of ' . $stack['location']['full_name'] . ' will learn to study the Bible, understand it, obey it, and share it.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, let knowledge and depth of insight abound more and more in the church of ' . $stack['location']['full_name'] . '.',
                'reference' => 'Philippians 1:9',
                'verse' => 'And this is my prayer: that your love may abound more and more in knowledge and depth of insight',
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_obedience( &$lists, $stack, $all = false ) {
        $section_label = 'Obedience';
        $templates = [
            [
                'section_label' => 'Obedience',
                'prayer' => 'Spirit, cause the '.$stack['location']['believers'].' believers in ' . $stack['location']['name'] . ' to obey with immediate, radical, costly obedience, like Abraham.',
                'reference' => 'Genesis 22:2-3',
                'verse' => 'Then God said, “Take your son, your only son, whom you love — Isaac — and go to the region of Moriah. Sacrifice him there as a burnt offering on a mountain I will show you.” Early the next morning Abraham got up and loaded his donkey. He took with him two of his servants and his son Isaac. When he had cut enough wood for the burnt offering, he set out for the place God had told him about.',
            ],
            [
                'section_label' => 'Obedience',
                'prayer' => 'Jesus, teach the believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' that love for you and obedience to you are connected.',
                'reference' => 'John 14:15',
                'verse' => 'If you love me, keep my commands.',
            ],
            [
                'section_label' => 'Obedience',
                'prayer' => 'Jesus, remind the disciples in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to train each other to obey all that you commanded, and that you will be with them as they do it.',
                'reference' => 'Matthew 28:20',
                'verse' => '...teaching them to obey everything I have commanded you. And surely I am with you always, to the very end of the age.',
            ],
            [
                'section_label' => 'Obedience',
                'prayer' => 'Jesus, please help the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to be filled with joyful obedience at all times, as you modeled for us all.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Obedience',
                'prayer' => 'Father, help the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' to know that you can make a big impact through their simple obedience today.',
                'reference' => 'Exodus 19:6',
                'verse' => '... you will be for me a kingdom of priests ...',
            ],
            [
                'section_label' => 'Obedience',
                'prayer' => 'Father, help the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' to know your commands and to do them.',
                'reference' => 'Ezra 7:10,25',
                'verse' => 'For Ezra had prepared his heart to seek the law of the LORD, and to do it, and to teach in Israel statutes and judgments.',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Psalm 119:10',
//                'verse' => 'I seek you with all my heart; do not let me stray from your commands.',
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
        $section_label = 'Reliance on God';
        $templates = [
            [
                'section_label' => 'Trust',
                'prayer' => 'Father, move the ' . $stack['location']['believers'] . ' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to say "Not our will, but yours be done", like Jesus.',
                'reference' => 'Luke 22:41-42',
                'verse' => 'He withdrew about a stone’s throw beyond them, knelt down and prayed, "Father, if you are willing, take this cup from me; yet not my will, but yours be done."',
            ],
            [
                'section_label' => 'Suffering',
                'prayer' => 'Spirit, please defend the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' against an unwillingness to suffer. Give them courage to face social rejection.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Trust',
                'prayer' => 'Please, convict the '.$stack['location']['believers'].' believers in '.$stack['location']['full_name'].' to look to you as their only hope for strength and fruitfulness and life.',
                'reference' => 'John 15:5',
                'verse' => 'I am the vine; you are the branches. If you remain in me and I in you, you will bear much fruit; apart from me you can do nothing.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, look after and teach the way that is best for the '.$stack['location']['believers'].' believers living in '.$stack['location']['full_name'].'.',
                'reference' => 'Psalm 32:8',
                'verse' => 'I will instruct you and teach you in the way which you shall go. I will counsel you with my eye on you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, train the church of '.$stack['location']['full_name'].' to trust with all their hearts, and you will make their paths straight.',
                'reference' => 'Proverbs 3:5-6',
                'verse' => 'Trust in Yahweh with all your heart, and don’t lean on your own understanding. In all your ways acknowledge him, and he will make your paths straight.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, remind your church in '.$stack['location']['name'].' that they can know and depend on the love you have for them.',
                'reference' => '1 John 4:16',
                'verse' => 'We know and have believed the love which God has for us. God is love, and he who remains in love remains in God, and God remains in him.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, encourage your church in '.$stack['location']['name'].' that you never forsake them.',
                'reference' => 'Psalm 9:10',
                'verse' => 'Those who know your name will put their trust in you, for you, Yahweh, have not forsaken those who seek you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, reveal your kingdom to those with a childlike heart in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Matthew 11:25-26',
                'verse' => 'At that time, Jesus answered, “I thank you, Father, Lord of heaven and earth, that you hid these things from the wise and understanding, and revealed them to infants. Yes, Father, for so it was well-pleasing in your sight.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, teach the '.$stack['location']['believers'].' believers that their old life is dead and their new life is hid with Christ.',
                'reference' => 'Colossians 3:3',
                'verse' => 'For you died, and your life is hidden with Christ in God.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Lord, to the people of '.$stack['location']['name'].' you say, "If you wait for Me, I will work on your behalf."',
                'reference' => 'Isaiah 64:4',
                'verse' => 'For from of old men have not heard, nor perceived by the ear, neither has the eye seen a God besides you, who works for him who waits for him.',
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_faithfulness( &$lists, $stack, $all = false ) {
        $section_label = 'Prayer Movement';
        $templates = [
            [
                'section_label' => 'Faith',
                'prayer' => "Spirit, teach the ".$stack['location']['believers']." believers in ".$stack['location']['name']." that when they seek first your Kingdom and your righteousness, you will abundantly provide all they need.",
                'reference' => '2 Corinthians 9:8',
                'verse' => 'And God is able to bless you abundantly, so that in all things at all times, having all that you need, you will abound in every good work.',
            ],
            [
                'section_label' => 'Faith',
                'prayer' => 'Lord, please give the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' the Spirit of wisdom and revelation, so that they might know you better.',
                'reference' => 'Ephesians 1:17',
                'verse' => 'I keep asking that the God of our Lord Jesus Christ, the glorious Father, may give you the Spirit of wisdom and revelation, so that you may know him better.',
            ],

            [
                'section_label' => 'Faith',
                'prayer' => 'Spirit, please defend the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' against self-centered spirituality. Open their eyes to the fields ripe for harvest around them.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Faithfulness',
                'prayer' => 'Father, convict the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' to be holy and righteous. Inspire them to gather in small groups for accountability and spiritual growth.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Faithfulness',
                'prayer' => 'Lord, we know that you invest more in those who have been faithful with what they have been given. Please, richly bless each faithful believer in '.$stack['location']['name'].' with more spiritual insight, wisdom, courage and vision.',
                'reference' => 'Matthew 25:28',
                'verse' => 'So take the bag of gold from him and give it to the one who has ten bags. For whoever has will be given more, and they will have an abundance. Whoever does not have, even what they have will be taken from them.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, please reward those who diligently seek you with a heart of faith in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Hebrews 11:6',
                'verse' => 'Without faith it is impossible to be well pleasing to him, for he who comes to God must believe that he exists, and that he is a rewarder of those who seek him.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, sanctify the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' and keep them blameless until Jesus returns.',
                'reference' => '1 Thessalonians 5:23-24',
                'verse' => 'May the God of peace himself sanctify you completely. May your whole spirit, soul, and body be preserved blameless at the coming of our Lord Jesus Christ. He who calls you is faithful, who will also do it.',
            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Hebrews 11:6',
//                'verse' => 'And without faith, it is impossible to please Him, for he who comes to God must believe that He is and that He is a rewarder of those who seek Him.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Lamentations 3:25',
//                'verse' => 'The LORD is good to them that wait for him, to the soul that seeks him.',
//            ],
//            [
//                'section_label' => $section_label,
//                'prayer' => '',
//                'reference' => 'Psalm 119:2',
//                'verse' => 'How blessed are those who observe His testimonies, who seek Him with all their heart?',
//            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_suffering( &$lists, $stack, $all = false ) {
        $section_label = 'Suffering';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, let those from the '.$stack['location']['believers'].' believers who are shaken and weak remember that your love will never fail them.',
                'reference' => '1 Corinthians 13:8',
                'verse' => 'Love never fails. But where there are prophecies, they will be done away with. Where there are various languages, they will cease. Where there is knowledge, it will be done away with.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, put the people who are lonely into families in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Psalm 68:6',
                'verse' => 'God sets the lonely in families. He brings out the prisoners with singing, but the rebellious dwell in a sun-scorched land.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, protect the overcomers in '.$stack['location']['full_name'].', so that they will one day sit with Jesus on His throne.',
                'reference' => 'Revelation 3:21',
                'verse' => 'He who overcomes, I will give to him to sit down with me on my throne, as I also overcame, and sat down with my Father on his throne.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, you have chosen the weak things of this world to confound the strong. Make the poor and outcast in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' a testimony of your strength.',
                'reference' => '1 Corinthians 1:27',
                'verse' => 'God chose the foolish things of the world that he might put to shame those who are wise. God chose the weak things of the world, that he might put to shame the things that are strong;',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, encourage the church of '.$stack['location']['full_name'].' that they are blessed with every heavenly blessing.',
                'reference' => 'Ephesians 1:3',
                'verse' => 'Blessed be the God and Father of our Lord Jesus Christ, who has blessed us with every spiritual blessing in the heavenly places in Christ',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, thank you that you will never abandon the church of '.$stack['location']['full_name'].'.',
                'reference' => 'Hebrews 13:5 ',
                'verse' => 'Be free from the love of money, content with such things as you have, for he has said, “I will in no way leave you, neither will I in any way forsake you.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, for those distressed and afraid in '.$stack['location']['full_name'].', show them today that you give peace at all times and in every situation.',
                'reference' => '2 Thessalonians 3:16',
                'verse' => 'Now may the Lord of peace himself give you peace at all times in all ways. The Lord be with you all.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, please find the broken hearted among the '.$stack['location']['population'].' souls in '.$stack['location']['name'].' and mend their wounds.',
                'reference' => 'Psalm 147:3',
                'verse' => 'He heals the broken in heart, and binds up their wounds.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, comfort those who mourn in '.$stack['location']['full_name'].'.',
                'reference' => 'Matthew 5:4',
                'verse' => 'Blessed are those who mourn, for they shall be comforted.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, see the suffering of your people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'. Deliver all those who have not forgotten your Word.',
                'reference' => 'Psalm 119:153',
                'verse' => 'Look on my suffering and deliver me, for I have not forgotten your law.',
            ],
        ];

        if ( $all ) {
            return array_merge( $templates, $lists );
        }
         $lists = array_merge( [ $templates[array_rand( $templates ) ] ], $lists );
        return $lists;
    }

    public static function _for_love_and_generosity( &$lists, $stack, $all = false ) {
        $section_label = 'Love';
        $templates = [
            [
                'section_label' => 'Love',
                'prayer' => 'Spirit, give the believers of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' unity and humility as they work to bring the kingdom to new people and places.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Love',
                'prayer' => 'Lord, stir the hearts of your people in ' . $stack['location']['name'] . ' to agree with you and with one another.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Love',
                'prayer' => 'Lord, stir the hearts of your people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to agree with you and with one another in love.',
                'reference' => 'John 17:21',
                'verse' => 'that all of them may be one, Father, just as you are in me and I am in you. May they also be in us so that the world may believe that you have sent me.',
            ],
            [
                'section_label' => 'Love',
                'prayer' => 'Lord, we pray for the believers in ' . $stack['location']['full_name'] . ' to be more like Jesus in their love for friends and enemies.',
                'reference' => 'Matthew 5:44',
                'verse' => 'But I tell you, love your enemies and pray for those who persecute you.',
            ],
            [
                'section_label' => 'The Church',
                'prayer' => 'Father, let love abound more and more in the church of ' . $stack['location']['full_name'] . '.',
                'reference' => 'Philippians 1:9',
                'verse' => 'And this is my prayer: that your love may abound more and more in knowledge and depth of insight',
            ],
            [
                'section_label' => 'Generosity',
                'prayer' => 'God, we pray for the believers in ' . $stack['location']['full_name'] . ' to be generous so that they would be worthy of greater investment by you.',
                'reference' => '',
                'verse' => '',
            ],
            [
                'section_label' => 'Love',
                'prayer' => 'Father, encourage the '.$stack['location']['believers'].' believers in '.$stack['location']['name'].' to not just be consumers of knowledge but be producers of love, mercy, kindness, and justice.',
                'reference' => '1 John 3:18',
                'verse' => '...let us not love with words or speech but with actions and in truth.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Oh Lord, show the fatherless in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' that you can be their real Father.',
                'reference' => '2 Corinthians 6:18',
                'verse' => 'I will be to you a Father. you will be to me sons and daughters,’ says the Lord Almighty.',
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
        $section_label = 'Urgency';
        $templates = [
            [
                'section_label' => $section_label,
                'prayer' => 'Father, give the disciples of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' an urgency of seeing every people and place reached for the gospel.',
                'reference' => 'John 9:4',
                'verse' => 'As long as it is day, we must do the works of him who sent me. Night is coming, when no one can work.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, encourage the disciples in '.$stack['location']['full_name'].' to live with urgency and a passion for making more disciples.',
                'reference' => 'James 4:14',
                'verse' => 'Yet you do not know what your life will be like tomorrow. you are just a vapor that appears for a little while and then vanishes away.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, defend the church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' against being inward-focused.',
                'reference' => 'Isaiah 61:1',
                'verse' => 'The Spirit of the Sovereign LORD is on me, because the LORD has anointed me to proclaim good news to the poor. He has sent me to bind up the brokenhearted, to proclaim freedom for the captives and release from darkness for the prisoners.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, encourage the church in '.$stack['location']['full_name'].' to make the most of every opportunity.',
                'reference' => 'Ephesians 5:15',
                'verse' => 'Be very careful, then, how you live—not as unwise but as wise, making the most of every opportunity, because the days are evil.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, your return is closer than when we first believed. Please, set urgency in the hearts of the people living in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Romans 13:11',
                'verse' => 'Besides this you know the time, that the hour has come for you to wake from sleep. For salvation is nearer to us now than when we first believed.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, disrupt complacency in the '.$stack['location']['believers'].' believers living in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'. Remind them you are coming soon.',
                'reference' => 'Matthew 24:42',
                'verse' => 'Therefore, stay awake, for you do not know on what day your Lord is coming.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, give faith and responsive hearts to the '.$stack['location']['population'].' citizens of the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Isaiah 55:6',
                'verse' => 'Seek the Lord while he may be found; call upon him while he is near;',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, renew the call of John the Baptist in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'. Send out bold servants who will call all to repent.',
                'reference' => 'Matthew 3:2',
                'verse' => 'Repent, for the kingdom of heaven is at hand.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Father, set on fire the hearts and passion of your church in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'.',
                'reference' => 'Romans 12:11',
                'verse' => 'Do not be slothful in zeal, be fervent in spirit, serve the Lord.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Spirit, awaken the sleepers and call them to repent and be baptized in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'. Set an urgency in their hearts.',
                'reference' => 'Acts 22:16',
                'verse' => 'And now why do you wait? Rise and be baptized and wash away your sins, calling on his name.’',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, defend your people in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' against the difficulty of these last days.',
                'reference' => '2 Timothy 3:1-4',
                'verse' => 'But understand this, that in the last days there will come times of difficulty. For people will be lovers of self, lovers of money, proud, arrogant, abusive, disobedient to their parents, ungrateful, unholy, heartless, unappeasable, slanderous, without self-control, brutal, not loving good, treacherous, reckless, swollen with conceit, lovers of pleasure rather than lovers of God, having the appearance of godliness, but denying its power.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Jesus, purify the '.$stack['location']['believers'].' believers in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].' to not just be hearers, but doers of your Word.',
                'reference' => 'Revelation 1:3',
                'verse' => 'Blessed is the one who reads aloud the words of this prophecy, and blessed are those who hear, and who keep what is written in it, for the time is near.',
            ],
            [
                'section_label' => $section_label,
                'prayer' => 'Holy Spirit, have mercy on the simple who turned from you in the '.$stack['location']['admin_level_name'].' of '.$stack['location']['name'].'. Warn them again against their complacency.',
                'reference' => 'Proverbs 1:32',
                'verse' => 'For the simple are killed by their turning away, and the complacency of fools destroys them;',
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
                'section_label' => 'Cities in '.$stack['location']['name'],
                'prayer' => 'Jesus, bring your gospel to the people living in '.$stack['location']['cities_list'] . '.',
                'reference' => 'Matthew 28:19-20',
                'verse' => 'Go therefore and make disciples of all nations, baptizing them in the name of the Father and of the Son and of the Holy Spirit, and teaching them to obey everything that I have commanded you.',
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
                'prayer' => 'Lord we ask you on behalf of the ' . $stack['least_reached']['name'] . ' people. ' . number_format( (float) $stack['least_reached']['PercentEvangelical'], 1 ) . '% are known to be believers. Oh God, please share with them the great gift of your son Jesus and your kingdom.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Lord, please remember the ' . $stack['least_reached']['name'] . ' people. you said you wanted worshippers of every tongue and tribe and nation, yet we know of no worshippers among them.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Lord, you sent Jesus as a witness to testify about the light so that all the ' . $stack['least_reached']['name'] . ' people might believe through him.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Lord, bring the blind by a way that they don’t know. Lead the ' . $stack['least_reached']['name'] . ' people in paths that they don’t know. Make darkness light before them and crooked places straight. Do not forsake the ' . $stack['least_reached']['name'] . ' people.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Lord, I thank you that you will bring health and a cure to the ' . $stack['least_reached']['name'] . ' people. Reveal to them abundance of peace and truth.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Father, open to your people a door for the word, to speak the mystery of Christ to the ' . $stack['least_reached']['name'] . ' people.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Father, I pray against the principalities, against the powers, against the world’s rulers of darkness of this age, and against the spiritual forces of the wickedness in the heavenly places that are warring against the ' . $stack['least_reached']['name'] . ' people.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Jesus, I pray that all the ' . $stack['least_reached']['name'] . ' people will remember and turn to you, Lord God. May all the ' . $stack['least_reached']['name'] . ' people worship before you. For the kingdom of the ' . $stack['least_reached']['name'] . ' people is yours.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Lord God, I thank you that the blood of Christ, who through the eternal Spirit offered himself without defect to God, can cleanse the ' . $stack['least_reached']['name'] . ' people conscience from dead works to serve the living God.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Spirit, I pray that the ' . $stack['least_reached']['name'] . ' people will come and worship before you, Lord. May they glorify your name for you are great.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Lord, Let your Kingdom come among the ' . $stack['least_reached']['name'] . ' people. Let your will be done, as in heaven, so on earth.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Lord, remember the ' . $stack['least_reached']['name'] . ' people. Make the ' . $stack['least_reached']['name'] . ' people a chosen race, a royal priesthood, a holy nation, a people for your own possession.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Father, I pray that the ' . $stack['least_reached']['name'] . ' people will not be afraid or ashamed. Prevent them from being confounded or disappointed in their search for you. May the ' . $stack['least_reached']['name'] . ' people know you.',
            ],
            [
                'section_summary' => '',
                'prayer' => 'Father, ' . number_format( (float) $stack['least_reached']['PercentEvangelical'], 1 ) . '% are known to be believers. Please, Lord call more today.',
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
                'section_summary' => 'What people or activities could you pray for in this photo?',
                'prayer' => '',
            ],
            [
                'section_summary' => 'What people or resources could you pray for in this photo?',
                'prayer' => '',
            ],
            [
                'section_summary' => 'What needs would people have here?',
                'prayer' => '',
            ],
            [
                'section_summary' => 'What blessing is needed here?',
                'prayer' => '',
            ],
            [
                'section_summary' => 'What conditions of religion or environment could you pray for here?',
                'prayer' => '',
            ],
            [
                'section_summary' => 'What challenges do people here face?',
                'prayer' => '',
            ],
            [
                'section_summary' => 'What beauty can God be thanked for in this photo?',
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
                'section_summary' => 'Pray that God raises up new churches in the city of ' . $key_city['full_name'] . '.',
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
                'prayer' => 'Pray that God encourage his people in all these cities.',
            ],
            [
                'prayer' => 'Pray that new churches are planted in these cities.',
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
                    'section_summary' => 'The ' . $stack['location']['admin_level_name'] . ' of <strong>' . $stack['location']['full_name'] . '</strong> has a population of <strong>' . $stack['location']['population'] . '</strong>.<br><br> We estimate ' . $stack['location']['name'] . ' has <strong>' . $stack['location']['believers'] . '</strong> people who might know Jesus, <strong>' . $stack['location']['christian_adherents'] . '</strong> people who might know about Jesus culturally, and <strong>' . $stack['location']['non_christians'] . '</strong> people who do not know Jesus.<br><br>This is <strong>1</strong> believer for every <strong>' . $stack['location']['lost_per_believer'] . '</strong> neighbors who need Jesus.',
                ],
            ],
            /**
             * PRAYERS TARGETING CULTURAL CHRISTIANS
             */
            'christian_adherents' => [
                [
                    'section_summary' => 'The ' . $stack['location']['admin_level_name'] . ' of <strong>' . $stack['location']['full_name'] . '</strong> has a population of <strong>' . $stack['location']['population'] . '</strong>.<br><br> We estimate ' . $stack['location']['name'] . ' has <strong>' . $stack['location']['believers'] . '</strong> people who might know Jesus, <strong>' . $stack['location']['christian_adherents'] . '</strong> people who might know about Jesus culturally, and <strong>' . $stack['location']['non_christians'] . '</strong> people who do not know Jesus.<br><br>This is <strong>1</strong> believer for every <strong>' . $stack['location']['lost_per_believer'] . '</strong> neighbors who need Jesus.',
                ],
            ],
            /**
             * PRAYERS TARGETING NON CHRISTIANS
             */
            'non_christians' => [
                [
                    'section_summary' => 'The ' . $stack['location']['admin_level_name'] . ' of <strong>' . $stack['location']['full_name'] . '</strong> has a population of <strong>' . $stack['location']['population'] . '</strong>.<br><br> We estimate ' . $stack['location']['name'] . ' has <strong>' . $stack['location']['believers'] . '</strong> people who might know Jesus, <strong>' . $stack['location']['christian_adherents'] . '</strong> people who might know about Jesus culturally, and <strong>' . $stack['location']['non_christians'] . '</strong> people who do not know Jesus.<br><br>This is <strong>1</strong> believer for every <strong>' . $stack['location']['lost_per_believer'] . '</strong> neighbors who need Jesus.',
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
        [admin_level_name] => county
        [admin_level_name_plural] => counties
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
