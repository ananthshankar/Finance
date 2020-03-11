<?php

namespace Finance\Profile;


interface QuoteInterface
{
	
	public function quote(array $value): array;
	public function getQuoteData(string $symbol): array;

}
?>  
