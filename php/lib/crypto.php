<?php
	class Crypto {
		private $buffer;
		private $hashedBuffer;

		public function __construct($buffer,$hashed) {
			$this->buffer = $buffer;
			$this->hashedBuffer = $hashed;
		}

		public function doCrypt() {
			$this->hashedBuffer = password_hash($this->buffer,PASSWORD_BCRYPT);
			return $this->hashedBuffer;
		}

		public function doMatch() {
			return password_verify($this->buffer,$this->hashedBuffer);
		}


	}