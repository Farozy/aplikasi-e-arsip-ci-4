<?php

/**
 * This file is part of the CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CodeIgniter\Format;

/**
 * Formatter interface
 */
interface FormatterInterface
{
	/**
	 * Takes the given data and formats it.
	 *
	 * @param string|array $data
	 *
	 * @return mixed
	 */
	public function format($data);
}
