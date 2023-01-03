<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourcesController extends Controller
{
    public function index() {

        $mediaCategories = [
            ['icon' => 'select_all', 'title' => 'All'],
            ['icon' => 'image', 'title' => 'Picture'],
            ['icon' => 'videocam', 'title' => 'Video'],
            ['icon' => 'audiotrack', 'title' => 'Music'],
            ['icon' => 'headset_mic', 'title' => 'Podcasts'],
            ['icon' => 'mic', 'title' => 'Interview'],
            ['icon' => 'group', 'title' => 'Funbase'],
            ['icon' => 'group', 'title' => 'Links'],
            ['icon' => 'dashboard_customize', 'title' => 'Other'],
        ];

        $contentImg = [
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://www.ferra.ru/thumb/1800x0/filters:quality(75):no_upscale()/imgs/2019/03/29/16/3029722/4c7bc8617cfe608af27ea17d1afb78c3a6be0476.jpg'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://stalkerportaal.ru/_pu/1/10615111.jpg'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://avatars.mds.yandex.net/get-zen_doc/1591100/pub_5e0f771a4e057700b19f7b7d_5e0f7a823d008800afe268f3/scale_1200'],
            ['title' => 'Village novice', 'date' => '24.04.21', 'img' => 'https://gamebomb.ru/files/galleries/001/0/01/354930.jpg'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'http://cossackland.org.ua/wp-content/uploads/2020/03/sm.STALKER2.750-696x392.jpg'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://cdna.artstation.com/p/assets/images/images/017/841/594/large/maksim-lisovskiy-stalker-by-maksim-lisovskij.jpg?1557524346'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://img2.wtftime.ru/store/2020/10/07/3iIxdFgw.jpg'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://i2.wp.com/itc.ua/wp-content/uploads/2020/10/bez-nazvaniya-4-scaled.jpg?fit=770%2C329&quality=100&strip=all&ssl=1'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://i.playground.ru/p/lE5dHoACsRZ5tCIiMu_OFg.jpeg'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://gamebomb.ru/files/galleries/001/a/a2/362732.jpg'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://images.unian.net/photos/2020_07/thumb_files/1000_545_1595573742-8604.png'],
            ['title' => 'STLAKER Title', 'date' => '24.04.21', 'img' => 'https://c.dns-shop.ru/thumb/st4/fit/760/600/3aaa3ee4e9593d54f8d1c1bee5822d5e/q93_d809b9eb594fffac2d7ab0d76505696286709106fa51d61bed09b4a0b3e74ba6.jpg'],
        ];

        $tags = ['features', 'sgc', 'art', 'concept', '2020', '2021', 'features', 'sgc', 'art', 'concept', '2020', '2021', 'features', 'sgc', 'art', 'concept', '2020', '2021', ];

        return view('resources.index', [
            'mediaCategories' => $mediaCategories,
            'content' => $contentImg,
            'tags' => $tags,
        ]);
    }
}
