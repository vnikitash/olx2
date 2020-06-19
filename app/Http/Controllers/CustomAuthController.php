<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 19.06.2020
 * Time: 20:43
 */

namespace App\Http\Controllers;


use App\Exceptions\Statistics2Exception;
use App\Exceptions\StatisticsException;
use App\Exceptions\UserDidNotSpecifyCredentialsException;
use App\Services\StatisticsService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    /**
     * @param Request $request
     * @throws UserDidNotSpecifyCredentialsException
     */
    public function login(Request $request, StatisticsService $service)
    {


        $client = new Client();
        $client->send("POST");

        $login = $request->input('login');
        $password = $request->input('password');
$success = true;

        try {

            if (!$login) {
                throw new UserDidNotSpecifyCredentialsException("User did not specify login ". json_encode($request->all()), 422);
            }

            if (!$password) {
                throw new UserDidNotSpecifyCredentialsException("User did not provide password. BODY: " . json_encode($request->all()), 422);
            }

            $service->sendStats("User tried to login");
            $service->sendStats2("User tried to login");

        } catch (StatisticsException $exception) {
            $success = false;
            echo "Statistics exception occurred, but i do not care, user should be able to log in" . PHP_EOL;;
        } catch (Statistics2Exception $exception) {
            $success = false;
            echo "This is stats 2 exception, But still login user!!!!!!!" . PHP_EOL;;
        } catch (UserDidNotSpecifyCredentialsException $e) {
            $success = false;
            throw $e;
        } finally {
            //Send success state to some server
            echo "FINAL STATAUS " . ($success ? "OK" : "ERROR") . PHP_EOL;
        }




        die("I will try to login user");
    }
}