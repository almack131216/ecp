<?php

add_shortcode('amcust_share_btns', 'print_amcust_share_btns');
function print_amcust_share_btns() {
    $tmpArray = Array();
    $tmpArray['twitter'] = Array('name'=>'twitter', 'title'=>'Twitter - English College in Prague', 'href'=>'https://twitter.com/ecp_prague', 'fa'=>'fa-twitter');
    $tmpArray['facebook'] = Array('name'=>'facebook', 'title'=>'Facebook - English College in Prague', 'href'=>'https://www.facebook.com/englishcollege', 'fa'=>'fa-facebook');
    $tmpArray['youtube'] = Array('name'=>'youtube', 'title'=>'YouTube Channel - English College in Prague', 'href'=>'https://www.youtube.com/user/TheEnglishCollege', 'fa'=>'fa-youtube');
    $tmpArray['instagram'] = Array('name'=>'instagram', 'title'=>'Instagram - English College in Prague', 'href'=>'https://www.instagram.com/ecp_prague', 'fa'=>'fa-instagram');
    // $tmpArray['newsletter'] = Array('name'=>'newsletter', 'title'=>'Newsletter', 'href'=>'https://inewsletter.co/the-english-college-in-prague/latest', 'fa'=>'fa-file-text-o');
    
    // $tmpContent .= '<a class="social" title="Twitter - English College in Prague" href="https://twitter.com/ecp_prague" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-twitter"></i>twitter</a>';
    // $tmpContent .= '<a class="social" title="Facebook - English College in Prague" href="https://www.facebook.com/englishcollege" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-facebook"></i>facebook</a>';
    // $tmpContent .= '<a class="social" title="YouTube Channel - English College in Prague" href="https://www.youtube.com/user/TheEnglishCollege" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-youtube"></i>youtube</a>';
    // $tmpContent .= '<a class="social" title="Newsletter" href="https://inewsletter.co/the-english-college-in-prague/latest" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-file-text-o"></i>newsletter</a>';
    
    $tmpContent = '<div class="contactus-social-icons-wrap">';
    $tmpContent .= '<div class="contactus-social-icons">';
    foreach($tmpArray as $item) {
        $tmpContent .= '<a class="disc '.$item['name'].'" title="'.$item['title'].'" href="'.$item['href'].'" target="_blank" rel="noopener noreferrer">';
        $tmpContent .= '<i class="fa fa-lg '.$item['fa'].'"></i></a>';
    }
    $tmpContent .= '</div>';
    $tmpContent .= '</div>';

    return $tmpContent;
	//return do_shortcode("[pagepart slug='more-information-share']");
}

add_shortcode('amcust_moreinfo_btns', 'print_amcust_moreinfo_btns');
function print_amcust_moreinfo_btns( $atts = array() ) {

    $switchTitle = "title";
    $switchHref = "href";
    if($atts['lang'] === 'cs'){
        $switchTitle = "titleCz";
        $switchHref = "hrefCz";
    }

    $btnsArrEn = Array();
    $btnsArrEn['news-events'] = Array('name'=>'news-events', 'title'=>'News & Events', 'href'=>'https://www.englishcollege.cz/news-events/', 'titleCz'=>'Novinky & Akce', 'hrefCz'=>'https://www.englishcollege.cz/cs/novinky-akce/', 'fa'=>'');
    $btnsArrEn['facebook'] = Array('name'=>'contact', 'title'=>'Contact us', 'href'=>'https://www.englishcollege.cz/contact-us/', 'titleCz'=>'Kontaktujte nás', 'hrefCz'=>'https://www.englishcollege.cz/cs/kontaktujte-nas/', 'fa'=>'');
    $btnsArrEn['newsletter'] = Array('name'=>'newsletter', 'title'=>'Newsletter', 'href'=>'https://inewsletter.co/the-english-college-in-prague/latest', 'titleCz'=>'Newsletter', 'hrefCz'=>'https://inewsletter.co/the-english-college-in-prague/latest', 'fa'=>'');

    $tmpContent = '<div class="moreinfo-btns">';
    // $tmpContent .= '<p>atts[lang]: '.$atts['lang'].'</p>';
    $tmpContent .= '<ul>';
    foreach($btnsArrEn as $item) {
        $tmpContent .= '<li>';
        $tmpContent .= '<a class="'.$item['name'].'" title="'.$item[$switchTitle].'" href="'.$item[$switchHref].'">'.$item[$switchTitle];
        $tmpContent .= '</a>';
        $tmpContent .= '</li>';
    }
    $tmpContent .= '</ul>';
    $tmpContent .= '</div>';

    return $tmpContent;
}


?>