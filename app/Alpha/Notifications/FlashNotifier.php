<?php namespace Alpha\Notifications;

use Illuminate\Session\Store;

class FlashNotifier
{
	private $session;

	private $glyph = [
		'success' => 'check',
		'danger' => 'ban',
		'warning' => 'warning',
		'info' => 'info'
	];

	function __construct (Store $session)
	{
		$this->session = $session;
	}

	public function info($message)
	{
		$this->message($message, 'info');
	}

	public function success($message)
	{
		$this->message($message, 'success');
	}

	public function error($message)
	{
		$this->message($message, 'danger');
	}

	public function warning($message)
	{
		$this->message($message, 'warning');
	}

	public function overlay($message)
	{
		$this->message($message);
		$this->session->flash('flash_notification.overlay', true);
	}

	public function message($message, $level = 'info')
	{
		$this->session->flash('flash_notification.message', $message);
		$this->session->flash('flash_notification.level', $level);
		$this->session->flash('flash_notification.glyph', $this->glyph[$level]);
	}
}