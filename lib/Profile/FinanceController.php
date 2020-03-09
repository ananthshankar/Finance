<?php 
namespace Finance\Profile;

use GuzzleHttp\Client;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;


class FinanceController implements ProfileInterface, QuoteInterface
{

   private $profileData = [];
   public $configpath;

   public function __construct(string $path)
   {
   	  $this->configpath = $path;
   }

   public function profile(array $value): array
   {
   	if(is_array($value)) $profilelData = $this->profileData = $value;
   	return $profilelData;
   }

   public function quote(array $value): array
   {
   	if(is_array($value)) $quoteData = $this->quoteData = $value;
   	return $quoteData;
   }


   public function __get ($key) 
   {
        return $this->profileData[$key];
   }

   public function __set($key, $value) 
   {
        $this->profileData[$key] = $value;
   }  


   public function getProfileData(string $symbol)
   {
   	
    $app_server_path = $this->configpath;
   	
    $client = new Client(['base_uri' =>$app_server_path]);
    $profilePath = $client->request('GET', 'company/profile/'.$symbol);
    $resProfile = json_decode($profilePath->getBody()->getContents(), true);
    
	try{
		
	    if($resProfile)
		{
		    	$resprofileData = $this->profile($resProfile['profile']);
		      	echo json_encode($resprofileData);
	    } else{
		    	echo "symbol Not Valid";	
	    }

		} catch(Exception $e){
			echo $e->getMessage();
		}  

    }

    public function getQuoteData(string $symbol)
    {
   	
    $app_server_path = $this->configpath;
   	
    $client = new Client(['base_uri' =>$app_server_path]);
    $quotePath = $client->request('GET', 'quote/'.$symbol);
    $resQuote = json_decode($quotePath->getBody()->getContents(), true);
	try{

    if($resQuote)
	{
	    	$resQuoteData = $this->quote($resQuote);
	      	echo json_encode($resQuoteData);
    } else{
	    	echo "symbol Not Valid";	
    }
	} catch(Exception $e){
		echo $e->getMessage();
	}  
 }
}


?>