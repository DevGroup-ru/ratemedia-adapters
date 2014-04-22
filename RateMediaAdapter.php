<?php

class RateMediaAdapter {


    /**
     * Returns <A> tag with link to survey
     * 
     * @param string $link_text Link anchor text(between opening and closing a tag)
     * @param integer $survey_id Id of survey
     * @param string $class CSS class attribute for a tag
     * @param string $id ID of DOM element for this tag
     * @param string $survey_click_event Special event name for determining source of click in RateMedia
     * @param string $success_url Success url - where user will be redirected after completion of survey
     * @param string $return_url URL for 'Back to site' button
     * @param array $user_profile Array of user_profile settings
     * @return string generated anchor tag.
     */
    public static function generateAnchor(
        $link_text, 
        $survey_id,
        $class = '', 
        $id = '',
        $survey_click_event = '',
        $success_url = '',
        $return_url = '',
        $user_profile = null
        )
    {
        $id = $id ? $id : 'ratemedia-'.md5(rand(0, PHP_INT_MAX).microtime(true));
        

        $href  = 'http://ratemedia.ru/frontend-survey/show?survey_id=' . intval($survey_id);
        
        if (!empty($survey_click_event)) {
            $href .= '&survey_click_event='.urlencode($survey_click_event);
        }
        
        if (!empty($success_url)) {
            $href .= '&success_url='.urlencode($success_url);
        }

        if (!empty($return_url)) {
            $href .= '&return_url='.urlencode($return_url);
        }
        
        if (function_exists('json_encode') && is_array($user_profile)) {
            $href .= '&user_profile='.urlencode(json_encode($user_profile));
        }



        $anchor = '<a href="' . $href. '" class="' . $class . '"'
            . 'id="' . $id . '"'
            . 'target="_blank">' . $link_text . '</a>';

        $anchor .= '<script>
        
        $(function(){
            if (typeof(_paq) === \'object\') {
                
                _paq.push([ function() { 
                    var visitor_id = this.getVisitorId(); 
                    document.getElementById("' . $id . '").href += "&piwik_visitor_id=" + visitor_id;
                }]);

                
            }
        })
        </script>';

        return $anchor;

    }

}