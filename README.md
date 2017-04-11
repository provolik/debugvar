<h2>DEBUG VAR FUNCTION FOR PHP</h2>

How many time did you write:

<pre>
echo '&lt;pre&gt;';
print_r($array);
echo '&lt;/pre&gt;';
</pre>

I am quite sure you know what I mean. So I created the debugVar function.

<h3>Installation</h3>

You can install it using composer from command line:

composer require provolik/debugvar

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
