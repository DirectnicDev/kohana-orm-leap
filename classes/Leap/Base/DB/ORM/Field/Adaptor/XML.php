<?php

/**
 * Copyright © 2011–2013 Spadefoot Team.
 *
 * Unless otherwise noted, LEAP is licensed under the Apache License,
 * Version 2.0 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License
 * at:
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * This class represents an "XML" adaptor for an XML formatted string field
 * in a database table.
 *
 * @package Leap
 * @category ORM
 * @version 2012-12-05
 *
 * @abstract
 */
abstract class Base\DB\ORM\Field\Adaptor\XML extends DB\ORM\Field\Adaptor {

	/**
	 * This constructor initializes the class.
	 *
	 * @access public
	 * @param DB\ORM\Model $model                   a reference to the implementing model
	 * @param array $metadata                       the adaptor's metadata
	 * @throws Throwable\InvalidArgument\Exception  indicates that an invalid field name
	 *                                              was specified
	 */
	public function __construct(DB\ORM\Model $model, Array $metadata = array()) {
		parent::__construct($model, $metadata['field']);
	}

	/**
	 * This function returns the value associated with the specified property.
	 *
	 * @access public
	 * @override
	 * @param string $key                           the name of the property
	 * @return mixed                                the value of the property
	 * @throws Throwable\InvalidProperty\Exception  indicates that the specified property is
	 *                                              either inaccessible or undefined
	 */
	public function __get($key) {
		switch ($key) {
			case 'value':
				$value = $this->model->{$this->metadata['field']};
				if (($value !== NULL) AND ! ($value instanceof DB\SQL\Expression)) {
					$value = new Core\Data\Serialization\XML($value);
				}
				return $value;
			break;
			default:
				if (isset($this->metadata[$key])) { return $this->metadata[$key]; }
			break;
		}
		throw new Throwable\InvalidProperty\Exception('Message: Unable to get the specified property. Reason: Property :key is either inaccessible or undefined.', array(':key' => $key));
	}

	/**
	 * This function sets the value for the specified key.
	 *
	 * @access public
	 * @override
	 * @param string $key                           the name of the property
	 * @param mixed $value                          the value of the property
	 * @throws Throwable\InvalidProperty\Exception  indicates that the specified property is
	 *                                              either inaccessible or undefined
	 */
	public function __set($key, $value) {
		switch ($key) {
			case 'value':
				if (is_object($value) AND ($value instanceof \SimpleXMLElement)) {
					$value = $value->asXML();
				}
				else if (is_array($value)) {
					$value = Core\Data\Serialization\XML::encode($value, TRUE);
				}
				$this->model->{$this->metadata['field']} = $value;
			break;
			default:
				throw new Throwable\InvalidProperty\Exception('Message: Unable to set the specified property. Reason: Property :key is either inaccessible or undefined.', array(':key' => $key, ':value' => $value));
			break;
		}
	}

}
