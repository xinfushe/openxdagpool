<?php

namespace App\Pool\Payouts;

use Carbon\Carbon;

class Payout
{
	protected $made_at, $made_at_milliseconds, $tag, $sender, $recipient, $amount;

	public function __construct($made_at, $tag, $sender, $recipient, $amount)
	{
		$made_at = explode('.', $made_at);
		$this->made_at = $made_at[0];
		$this->made_at_milliseconds = intval($made_at[1] ?? 0);
		$this->tag = $tag;
		$this->sender = $sender;
		$this->recipient = $recipient;
		$this->amount = $amount > 1024 ? 0 : $amount; // this is a bug in pool software, such transaction must be rejected
	}

	public function getMadeAt()
	{
		return Carbon::parse($this->made_at . '.' . sprintf('%06d', $this->made_at_milliseconds * 1000));
	}

	public function getTag()
	{
		return $this->tag;
	}

	public function getSender()
	{
		return $this->sender;
	}

	public function getRecipient()
	{
		return $this->recipient;
	}

	public function getAmount()
	{
		return $this->amount;
	}
}
