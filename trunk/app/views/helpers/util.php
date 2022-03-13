<?php /** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/**
 * Common utilities for helpers
 * @property $Html
 * @author  RosSoft
 * @version 0.20
 * @package helpers
 */
class UtilHelper extends Helper {
    /**
     * @var string[]
     */
   public $helpers = array('Html');

   /**
	* Converts a string like Model/field to
	* the string data[Model][field] useful for forms (input name)
	*
	* @param string $fieldName Model/field
	*
	* @return string
	*/
   public function fieldname_to_formname($fieldName) {
	  if (strpos($fieldName, '/')) {
		 $arr   = preg_split('/', $fieldName);
		 /*$model = $arr[0];
		 $field = $arr[1];*/
		 return sprintf("data[%s][%s]", $arr[0], $arr[1]);
	  }

       return $fieldName;
   }

   /**
	* Retrieves the value from data array of field passed
	*
	* @param string $fieldName Model/field
	*
	* @return string The value from the data array
	*/
   public function retrieve_value($fieldName) {
	  if (strpos($fieldName, '/')) {
		 $arr   = preg_split('/', $fieldName);
		 $model = $arr[0];
		 $field = $arr[1];
		 if (!isset($this->params['data'][$model][$field])) {
             if (isset($this->data[$model][$field])) {
                 return $this->data[$model][$field];
             }

             return false;
         }

          return $this->params['data'][$model][$field];
      }
      return false;
   }

   /**
	* This is a copy of the same function in HtmlHelper
	* Returns a space-delimited string with items of the $options array. If a
	* key of $options array happens to be one of:
	*    + 'compact'
	*    + 'checked'
	*    + 'declare'
	*    + 'readonly'
	*    + 'disabled'
	*    + 'selected'
	*    + 'defer'
	*    + 'ismap'
	*    + 'nohref'
	*    + 'noshade'
	*    + 'nowrap'
	*    + 'multiple'
	*    + 'noresize'
	* And its value is one of:
	*    + 1
	*    + true
	*    + 'true'
	* Then the value will be reset to be identical with key's name.
	* If the value is not one of these 3, the parameter is not output.
	*
	* @param array  $options      Array of options.
	* @param array  $exclude      Array of options to be excluded.
	* @param string $insertBefore String to be inserted before options.
	* @param string $insertAfter  String to be inserted ater options.
	*
	* @return string
	*/
   public function parse_attributes($options,
                                    $exclude = null,
                                    $insertBefore = ' ',
                                    $insertAfter = null) {
	  $minimizedAttributes = array(
		  'compact',
		  'checked',
		  'declare',
		  'readonly',
		  'disabled',
		  'selected',
		  'defer',
		  'ismap',
		  'nohref',
		  'noshade',
		  'nowrap',
		  'multiple',
		  'noresize');

	  if (!is_array($exclude)) {
		 $exclude = array();
	  }

	  if (is_array($options)) {
		 $out = array();

		 foreach ($options as $key => $value) {
			if (!in_array($key, $exclude, true)) {
			   if (in_array($key, $minimizedAttributes, true) && ($value === 1 ||
					   $value === true || $value === 'true' || in_array($value, $minimizedAttributes, true))) {
				  $value = $key;
			   }
			   elseif (in_array($key, $minimizedAttributes, true)) {
				  continue;
			   }
			   $out[] = sprintf("%s=\"%s\"", $key, $value);
			}
		 }
		 $out = implode(' ', $out);
		 return $out ? $insertBefore . $out . $insertAfter : null;
	  }

       return $options ? $insertBefore . $out . $insertAfter : null;
   }

   /**
	* Converts a string like Model/field to Model/Field
	* useful for forms (DOM ID)
	*
	* @param string $fieldName Model/field
	*
	* @return string ModelField
	*/
   public function fieldname_to_formid($fieldName) {
	  if (!strpos($fieldName, '/')) {
          return $fieldName;
      }

       $arr = preg_split('/', $fieldName);
       return $arr[0] . Inflector::camelize($arr[1]);
   }

   /**
	* Converts a cake url to an absolute url
	*
	* @param string $cake_url An URL like /controller/action/param1/param2
	*
	* @return string An absolute url like http://yourdomain.com/your_path_to_cake/controller/action/param1/param2
	*/
   public function to_absolute_url($cake_url) {
	  return FULL_BASE_URL . $this->Html->url($cake_url);
   }
}

