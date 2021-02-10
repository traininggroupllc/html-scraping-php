<?php


//Set a user agent. This basically tells the server that we are using Chrome ;)
define('USER_AGENT', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.2309.372 Safari/537.36');

//Where our cookie information will be stored (needed for authentication).
define('COOKIE_FILE', 'cookie.txt');

//URL of the login form.

$curl = curl_init();
$arrayhref = array();

for($i=970; $i <= 980;$i++){
        if($i==1)
        $innerUrl='https://www.subito.it/annunci-italia/vendita/cerco-lavoro/';
        else
        $innerUrl='https://www.subito.it/annunci-italia/vendita/cerco-lavoro/?o='.$i;

        $ch = curl_init($innerUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $html = curl_exec($ch);
        $dom = new DOMDocument();
        @$dom->loadHtml($html);
        // var_dump($dom);
        // die;
        $nodes=$dom->getElementsByTagName('a');
        foreach ($nodes as $node) {
            $class=$node->getAttribute('class');
             if(strpos($class, 'link')==15) {
                $arrayhref[]=$node->getAttribute('href');
             }   
        }
        curl_close($ch);
}


foreach ($arrayhref as $href) {
        $href=$href;     
        $curl = curl_init($href);
        //Initiate cURL.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $html=curl_exec($curl);
        $dom = new DOMDocument();
        @$dom->loadHtml($html);
        if ($dom->getElementById("sticky-cta-container")){
                $nodes = $dom->getElementById("sticky-cta-container");
                if($nodes->getAttribute('data-prop-phone')){
                        echo '<h3>'.$nodes->getAttribute('data-prop-phone').'</h3>';
                        echo "<hr>";
                }
        }
        curl_close($curl);
}