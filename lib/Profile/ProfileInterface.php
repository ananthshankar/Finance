<?php

namespace Finance\Profile;

interface ProfileInterface
{
	public function __construct(string $path);
	public function profile(array $value): array;
	public function getProfileData(string $symbol): array;

}
?>  
