<?php

namespace Finance\Profile;
use Psr\Http\Message\ResponseInterface;

interface ProfileInterface
{
	
	public function profile(array $value): array;
	public function getProfileData(string $symbol);

}
?>  
