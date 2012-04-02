<!DOCTYPE html><html><head><title>An Example Class</title></head><body>
<?php
// Adam Gelman, April 2012
// initialise new instance of StringManipulation
$theTest = new StringManipulation();
// set some text inside this variable
$theTest->setString('Hello World!');
// make some modifications to the style
print "theTest before being made bold : "
	. $theTest->getString()
	. "<br>";
$theTest->makeStringBold();
print "theTest after being made bold : "
	. $theTest->getString()
	. "<br>";
// make a clone of this variable so we can perform other actions
print " make clones of theTest : the2ndTest,the3rdTest <br>";
$the2ndTest = clone($theTest);

// output contents
print "variable 'the2ndTest' just after being copied from 'theTest', and before setting string : " 
	. $the2ndTest->getString()
	. "<br>";
// set contents
$the2ndTest->setString('Mary had a little lamb');
// output contents
print "variable 'the2ndTest' after setting string contents : "
	. $the2ndTest->getString()	
	. "<br>";
// make some modifications to the style
$the2ndTest->makeStringItalicized();
print "variable 'the2ndTest' after being italicized : "
	. $the2ndTest->getString()	
	. "<br>";
// clone 2nd variable to a 3rd variable
print "cloning variable the2ndTest to the4thTest...<br>\n";
$the3rdTest = clone($the2ndTest);

// set the contents
$the3rdTest->setString("<p><b>Lorem Ipsum dolor sit amet</b>...<br>"
."consectetur adipiscing elit. Mauris ligula eros, porta consectetur "
."vehicula vitae, <a href=\"http://www.google.com/\" style=\"font-color:red;\">Follow this link</a>.</p>"
."<p><a href=\"http://www.yahoo.com/\" style=\"font-size:10pt;\">This is another link</a></p>");
//output the contents
print "this is what the4thTest looks like in plain text : <br>"
	."<textarea rows=\"5\" cols=\"50\">" . $the3rdTest->getString()
	."</textarea><br>";
// pick out hyperlinks in the text
$the3rdTestArray = $the3rdTest->seperateLinks();
print " Parse the4thTest variable for links using a regular expression:<br> ";
foreach ($the3rdTestArray as $item) {
	print("URL:<b>".$item[2]."</b><br>");
	print("Anchor Text:<b>".$item[3]."</b><br>");
}
// ditch these variables etc to free up resources
unset($theTest);
unset($the2ndTest);
unset($the3rdTest);
unset($the3rdTestArray);

?>
</body></html>
<?
class StringManipulation {
  public $string;
  public function getString() {
 	// return contents of string
  	return $this->string;
  }
  public function setString($string_data) {
	// set contents of string to $string_data argument
    $this->string = $string_data;
  }
  public function makeStringBold() {
  	// add <B> tags to string
	$this->string = "<b>" . $this->string . "</b>";
  }
  public function makeStringItalicized() {
  	// add <EM> tags to string
    $this->string = "<em>" . $this->string . "</em>";
  }
  public function seperateLinks() {
	// match hyperlinks within string and return all as ordered arrays (element 2 is URL, element 3 is anchor text)
  	if(preg_match_all("/<a href=(\")([^\" >]*?)\\1[^>]*?>(.*)<\/a>/siU", $this->string, $matches, PREG_SET_ORDER)) {
  		return $matches;
  	}
  }  
}
?>