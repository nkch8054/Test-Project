<?php
function sayidan_shortcode_twitter( $atts, $content = null ) {
	extract( shortcode_atts( array(
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts ) );

	ob_start();
    if(!isset($after_widget))
        $after_widget='';
    
    //check if cache needs update
    $sayidan_twitter = get_option( 'sayidan_twitter' );
    $diff = time() - $sayidan_twitter;
    $crt = get_theme_mod( 'twitter_cache' ) * 3600;
    
    //	yes, it needs update
    if ( $diff >= $crt || empty( $sayidan_twitter ) ){
        
        
        if( !class_exists( 'OAuthSignatureMethod_HMAC_SHA1' ) ) : 

        if ( !require_once(  plugin_dir_path(__FILE__) . 'widgets/recent-tweets-widget/twitteroauth.php' ) ){
            echo '<strong>'.__('Couldn\'t find twitteroauth.php!','sayidan').'</strong>' . $after_widget;
            return;
        }

        endif;
        
        function getConnectionWithAccessToken( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret ) {
            $connection = new TwitterOAuth( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret );
            return $connection;
        }

        $connection = getConnectionWithAccessToken( get_theme_mod( 'twitter_c_key' ), get_theme_mod( 'twitter_c_secret' ), get_theme_mod( 'twitter_a_token' ), get_theme_mod( 'twitter_a_secret' ) );
        $tweets = $connection->get( "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".get_theme_mod( 'twitter_username' )."&count=1&exclude_replies=true" ) or die( 'Couldn\'t retrieve tweets! Wrong username?' );
        
        //var_dump($tweets->errors);
        if( !empty( $tweets->errors ) ){
            if( $tweets->errors[0]->message == 'Invalid or expired token' ){
                echo '<strong>'.$tweets->errors[0]->message.'!</strong><br> Go to Customizer &gt; Social Networks &gt; Provide Twitter Keys and Tokens<br> or remove <strong>[sayidan_twitter]</strong> shortcode from this page<br />' . __( 'You\'ll need to regenerate it <a href="https://apps.twitter.com/" target="_blank">here</a>!', 'sayidan' ) . $after_widget;
            }else{
                echo '<strong>'.$tweets->errors[0]->message.'!</strong><br> Go to Customizer &gt; Social Networks &gt; Provide Twitter Keys and Tokens<br> or remove <strong>[sayidan_twitter]</strong> shortcode from this page' . $after_widget;
            }
            return;
        }
        
        $tweets_array = array();
        for( $i = 0; $i <= count( $tweets ); $i++ ){
            if( !empty( $tweets[$i] ) ){
                $tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
                //clean tweet text
                $tweets_array[$i]['text'] = preg_replace( '/[\x{10000}-\x{10FFFF}]/u', '', $tweets[$i]->text );
                
                if( !empty( $tweets[$i]->id_str ) ){
                    $tweets_array[$i]['status_id'] = $tweets[$i]->id_str;
                }
            }
        }
        
        //save tweets to wp option
        update_option( 'sayidan_twitter_plugin_tweets', serialize( $tweets_array ) );
        update_option( 'sayidan_twitter', time() );
        
        echo '<!-- twitter cache has been updated! -->';
    }
    
	
    $sayidan_twitter_plugin_tweets = maybe_unserialize( get_option( 'sayidan_twitter_plugin_tweets' ) );
    if( !empty( $sayidan_twitter_plugin_tweets ) && is_array( $sayidan_twitter_plugin_tweets ) ){ ?>
    <div class="twitter-stream">
        <div class="container">
            <div class="twitter-wrapper text-center">
                <div class="twitter-icon color-theme">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </div>
                <div class="twitter-content">
                    <div class="twitter-desc">
                        <div class="text-light text-center">
                        <?php $fctr = '1';
                            foreach ( $sayidan_twitter_plugin_tweets as $tweet ){
                                if ( !empty( $tweet['text'] ) ){
                                    
                                    if ( empty( $tweet['status_id'] ) ){ $tweet['status_id'] = ''; }
                                    if ( empty( $tweet['created_at'] ) ){ $tweet['created_at'] = ''; } ?>

                                    <div class="twitter-desc">
                                        <p class="text-light text-center">“<?php echo tp_convert_links( $tweet['text'] ); ?>“</p>
                                    </div>
                                    <?php
                                    if ( $fctr == 1 ){ break; }
                                    $fctr++;
                                }
                            }
                        ?>
                        </div>
                        <div class="twitter-user">
                            <!--<span class="avatar-user"><img src="images/avatar.png" alt=""></span>-->
                            <span class="name">@<?php echo get_theme_mod( 'twitter_username' ); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        
    }else{
        print '<div class="sayidan_recent_tweets">' . __('<b>Error!</b> Couldn\'t retrieve tweets for some reason!','sayidan') . '</div>';
    }
        
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}