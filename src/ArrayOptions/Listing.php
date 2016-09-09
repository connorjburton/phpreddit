<?php
/**
 * Copyright (c) 2016 halfpastfour.am
 * MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
 * Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Halfpastfour\Reddit\ArrayOptions;

/**
 * Class Listing
 * @package Halfpastfour\Reddit\ArrayOptions
 */
class Listing
{
	/**
	 * @var bool
	 */
	private $shouldPaginate = false;

	/**
	 * @var string
	 */
	private $after;

	/**
	 * @var string
	 */
	private $before;

	/**
	 * @var int
	 */
	private $count = 0;

	/**
	 * @var int
	 */
	private $limit = 25;

	/**
	 * @var string|null
	 */
	private $show;

	/**
	 * @var
	 */
	private $subredditDetail;

	/**
	 * @return bool
	 */
	public function isPaginating()
	{
		return ( $this->shouldPaginate === 'increment' || $this->shouldPaginate === 'decrement' );
	}

	/**
	 * @param $paginationDirection
	 */
	public function setPaginationDirection( $paginationDirection )
	{
		if( $paginationDirection === 'increment' || $paginationDirection === 'decrement' ) {
			$this->shouldPaginate = $paginationDirection;
		}
	}

	/**
	 * @return bool
	 */
	public function disablePagination()
	{
		$this->shouldPaginate = false;
	}

	/**
	 * @return string|null
	 */
	public function getAfter()
	{
		return $this->after;
	}

	/**
	 * @param string $p_sAfter
	 *
	 * @return Listing
	 */
	public function setAfter( $p_sAfter )
	{
		$this->after = strval( $p_sAfter );

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getBefore()
	{
		return $this->before;
	}

	/**
	 * @param string $p_sBefore
	 *
	 * @return Listing
	 */
	public function setBefore( $p_sBefore )
	{
		$this->before = $p_sBefore;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getCount()
	{
		return $this->count;
	}

	/**
	 * @param int $p_iCount
	 *
	 * @return Listing
	 */
	public function setCount( $p_iCount )
	{
		$this->count = intval( $p_iCount );

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getLimit()
	{
		return $this->limit;
	}

	/**
	 * @param int $p_iLimit
	 *
	 * @return Listing
	 */
	public function setLimit( $p_iLimit )
	{
		$this->limit = intval( $p_iLimit );

		return $this;
	}

	/**
	 * @return Listing
	 */
	public function enableShow()
	{
		$this->show = 'all';

		return $this;
	}

	/**
	 * @return Listing
	 */
	public function disableShow()
	{
		$this->show = null;

		return $this;
	}

	/**
	 * @return Listing
	 */
	public function enableSubredditDetail()
	{
		$this->subredditDetail = true;

		return $this;
	}

	/**
	 * @return Listing
	 */
	public function disableSubredditDetail()
	{
		$this->subredditDetail = false;

		return $this;
	}

	/**
	 * Output the listing for use in an API request.
	 *
	 * @return array The listing as an array.
	 */
	public function output()
	{
		if( isset( $this->after ) ) {
			$output['p_sAfter'] = $this->getAfter();
		} else if( isset( $this->before ) ) {
			$output['p_sBefore'] = $this->getBefore();
		}

		$output['limit']    = $this->limit;
		$output['p_iCount'] = $this->count;

		if( $this->show === 'all' ) {
			$output['show'] = 'all';
		}

		$output['sr_detail'] = $this->subredditDetail;

		return $output;
	}

	/**
	 * @return Listing
	 */
	public function incrementPagination()
	{
		$this->count += $this->limit;

		return $this;
	}

	/**
	 * @return Listing
	 */
	public function decrementPagination()
	{
		$this->count -= $this->limit;

		return $this;
	}
}