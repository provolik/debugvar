<h2>DEBUG VAR FUNCTION FOR PHP</h2>

How many time did you write:

<pre>
echo '&lt;pre&gt;';
print_r($array);
echo '&lt;/pre&gt;';
</pre>

I am quite sure you know what I mean. So I created the debugVar function.

<h3>Installation</h3>

Put this function in a file that your project load by default.

<h3>Installation for Codeigniter</h3>

Create a debug_helper.php in application/helpers folder and put the
function there. Then in config/autoload.php insert the debug_helper
in the autoload helper list.

<h3>Installation for Wordpress</h3>

Simply put this function in your functions.php

<h3>How to use</h3>

If you want know the content of your var, simply put it in the function, like this:

debugvar($variables);

You can pass to it how many vars you want:

debugvar($var1, $var2, $var3, $var4);

Often you need to show the var and then call a die:

debugvar_die($variables);

In other circumstances, for example in production environment, you need to print a var in hide mode:

debugvar_hide($variables);

And that's all.
