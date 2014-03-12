DEBUG VAR FUNCTION FOR PHP

How many time did you write:

echo '<pre>';
print_r($array);
echo '</pre>'

I am quite sure you know what I mean. So I created th debugVar function.

INSTALL

Put this function in a file that your project load by default.

INSTALL FOR CODEIGNITER

Create a debug_helper.php in application/helpers folder and put the
function there. Then in config/autoload.php insert the debug_helper
in the autoload helper list.

INSTALL FOR WORDPRESS

Simply put this function in your functions.php

HOW TO USE

If you want know the content of your var, simply put it in the function, like this:

debugVar($variables);

You can pass to it how many vars you want:

debugVar($var1, $var2, $var3, $var4);

You can pass to it two booleans. The first one, if true, will call a die() after
the print, the second one, if true, will change the PRE tags with <!-- and -->
so you can print your debug in a production project without show anything.

