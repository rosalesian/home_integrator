<?php

class BaseController extends Controller {

	protected $layout = 'layouts.default';
	protected $viewBase = '';
	protected $currentUser = '';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function view($viewName, $data = [])
	{
		$view = View::make("{$this->viewBase}.{$viewName}", $data);
		$this->layout->content = $view;
		return $view;
	}

	protected function currentUser()
	{
		$this->currentUser = Auth::user();
		return $this->currentUser;
	}

	protected function input()
	{
		return Input::only();
	}
}
