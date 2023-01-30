<?php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;
use Exception;

class AuthController extends Controller
{

    public function init()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        if (!empty($_REQUEST['lang'])) {
            if (in_array($_REQUEST['lang'], ['en', 'ru', 'kz'])) {
                $session->set('lang', $_REQUEST['lang']);
            } else {
                $session->set('lang', 'en');
            }
        }
        if (!empty($_SESSION['lang'])) {
            Yii::$app->language = $_SESSION['lang'];
        } else {
            Yii::$app->language = 'ru';
        }
        parent::init();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        function get_web_page($url)
        {
            $cookie = dirname(__DIR__) . "/cookie.txt";
            $uagent = "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14";
            $uagent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36";
            try {
                $ch = curl_init($url);
                if ($ch === false) {
                    throw new Exception("Initialization Failed");
                }

                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'HTTP/1.1',
                    'Content-type: application/jsonx',
                    'Authorization: Bearer ' . Yii::$app->user->identity->access_token
                ));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
                curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
                $content = curl_exec($ch);
                if ($content === false) {
                    throw new Exception(curl_error($ch), curl_errno($ch));
                }
                $httpReturnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($httpReturnCode == 200) {
                    return $content;
                }
            } catch (Exception $e) {
                trigger_error(
                    sprintf(
                        'Curl failed with error #%d: %s',
                        $e->getCode(),
                        $e->getMessage()
                    ),
                    E_USER_ERROR
                );
            } finally {
                if (is_resource($ch)) {
                    curl_close($ch);
                }
            }
        }

        function send_post($url, $fields)
        {
            // $post_data = json_encode($fields);
            $cookie = dirname(__DIR__) . "/cookie_post.txt";
            $uagent = "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14";
            $uagent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.87 Safari/537.36";
            try {
                $ch = curl_init($url);
                if ($ch === false) {
                    throw new Exception("Initialization Failed");
                }
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Authorization: Bearer ' . Yii::$app->user->identity->access_token
                    )
                );
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                $result = curl_exec($ch);
                if ($result === false) {
                    throw new Exception(curl_error($ch), curl_errno($ch));
                }
                $httpReturnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($httpReturnCode == 200) {
                    return $result;
                }
            } catch (Exception $e) {
                trigger_error(
                    sprintf(
                        'Curl failed with error #%d: %s',
                        $e->getCode(),
                        $e->getMessage()
                    ),
                    E_USER_ERROR
                );
            } finally {
                if (is_resource($ch)) {
                    curl_close($ch);
                }
            }
        }
        return $behaviors;
    }
}
