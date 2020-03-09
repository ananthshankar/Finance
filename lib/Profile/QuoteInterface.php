<?php

namespace Finance\Profile;
use Psr\Http\Message\ResponseInterface;
interface QuoteInterface
{
	public function __construct(string $path);	
	public function quote(array $value): array;
	public function getQuoteData(string $symbol);

}
?>  
