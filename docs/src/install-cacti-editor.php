<?php
        include "vars.php";
        $PAGE_TITLE="Installation - Cacti Plugin &amp; Editor";
        include "common-page-head.php";
?>

            <h2>Installation</h2>

            <h3>Cacti plugin and Editor</h3>

            <h4>Requirements</h4>

            <p><strong>Before</strong> doing anything else, please verify that your
            <a href = "http://cactiusers.org/">Plugin Architecture</a> is working
            properly with a simpler plugin, like
            <a href = "http://wotsit.thingy.com/haj/cacti/links-plugin.html">Links</a> or
            <a href = "http://cactiusers.org/">Tools</a>. Weathermap is relatively
            complex, and fault-finding both your Cacti Plugin Architecture and
            Weathermap at the same time will make life harder for you!</p>

            <p>You will need the 'pcre' and 'gd' PHP modules in
            <em>both your command-line and server-side (mod_php/ISAPI) PHP</em>. The
            poller-process runs using the command-line PHP, and the editor uses the
            server-side one. In some situations it is possible to have two completely
            different PHP installations serving these two
            - if you install from a package, then re-install from source, but to a
            different directory, for example. The editor and the poller process should
            both warn you if the part they need is not present.</p>

            <p>You can then use the pre-install checker to see if your PHP environment
            has everything it needs. To do this, you need to run a special
            <tt>check.php</tt> script, twice...</p>

            <p>First, go to http://yourcactiserver/plugins/weathermap/check.php to see
            if your webserver PHP (mod_php, ISAPI etc) is OK. Then, from a
            command-prompt run
            <tt>php check.php</tt> to see if your command-line PHP is OK. If any modules
            or functions are missing, you will get a warning, and an explanation of what
            will be affected (not all of the things that are checked are deadly
            problems).</p>

            <p>Before you start using it, you might want to change one PHP setting.
            Weathermap uses a fair bit of memory by PHP standards, as it builds the
            image for the map in memory before saving it. As a result, your PHP process
            <i>may</i> run out of memory. PHP has a 'safety valve' built-in, to stop
            runaway scripts from killing your server, which defaults to 8MB in most
            versions (this has changed in 5.2.x). This is controlled by the
            'memory_limit =' line in php.ini. You may need to increase this to 32MB or
            even more if you have problems. In fact, the current Cacti manual suggests
            128MB. These problems will typically show up as the poller process just
            dying with no warning or error message, as PHP kills the script.</p>

            <h4>Installation</h4>

            <p>To use the Cacti plugin, you
            <i>must</i> unpack the zip file into a directory called
            '<i>&lt;cacti_root&gt;</i>/plugins/weathermap'. The zip contains a folder
            called 'weathermap' already, so unzipping it in the plugins folder should do
            the job.</p>

            <h4>File Permissions</h4>

            <p>
            You will need to change the permissions on the
            <tt>output</tt> directory, so that the Cacti poller process can write to it.
            This is the same as you would have done for the
            <tt>rra</tt> directory while installing Cacti itself originally. For a *nix
            system, it will be something like:

            <div class = "shell">
                <pre>
                                chown cactiuser output
</pre>
            </div>

            <h4>Getting Started</h4>

            <p>Log in to the Cacti application, and go to the Plugin Management page.
            You should see the Weathermap plugin as an uninstalled plugin. Click the 'install' icon
next to its name, and then click the 'enable' icon that appears next to that. If you are logged in
as the 'admin' user, you should see the 'Weathermap' tab appear at the top of the Cacti page.</p>

            <p>That's it! The Weathermap plugin is installed. </p>
<p>To allow other users to see it, you need to go to the User Management page in Cacti, and grant those users
the extra permissions that should appear there now, to either View Weathermaps (for customers) and/or Manage Weathermaps (for admin users).</p>

    <p>To go further, you need
            some weathermap configuration files to define your maps. You can do this in
            two ways
            - using the Web-based map editor, or by editing the text-based configuration
            files directly.</p>

            <p>To use the editor, you need to make a few more changes (see below). </p>

            <p>To learn more about actually <i>using</i> the Cacti plugin, see the
            <a href = "cacti-plugin.html">Cacti Plugin page</a>.</p>

            <h4>The Editor</h4>

            <p>Once you have weathermap itself working, continue onto the editor:</p>

            <p>
            Copy the <tt>editor-config.php-dist</tt> file to
            <tt>editor-config.php</tt>. If you want to be able to pick data sources from
            your Cacti installation by name, edit the file and make sure that the line
            that sets
            <tt>$cacti_base</tt> is correct, and that the base URI below that is also
            correct for your Cacti installation (these two lines are marked CHANGE in
            the file).
            </p>

            <p>
            Make sure that your webserver can write to the configs directory. To do
            this, you need to know which user your webserver runs as (maybe 'nobody',
            'www' or 'httpd' on most *nixes) and then run:

            <div class = "shell">
                <pre>chown www configs
                                chmod u+w configs</pre>
            </div>

            In a pinch, you can just <tt>chmod 777 configs</tt>, but this
            <em>really isn't</em> a recommended solution for a production system.</p>

            <p>On Windows, the same applies
            - the user that runs the webserver runs as should have permissions to write
            new files, and change existing files in the configs folder.</p>
            </p>

            <p>Since version 0.97, you now also need to enable the editor. The reason is
            so that you can't have the editor enabled without knowing about it. The
            editor allows access to your config files without authentication (it doesn't
            use Cacti's authentication), so you should consider using features in your
            webserver to limit who can access
            <tt>editor.php</tt>. For example, on an Apache server, something like:

            <pre>
                            &lt;Directory /var/www/html/cacti/plugins/weathermap&gt;
                                &lt;Files editor.php&gt;
                                    Order Deny,Allow
                                    Deny from all
                                    Allow from 127.0.0.1
                                &lt;/FilesMatch&gt;
                            &lt;/Directory&gt;
            </pre>
            When you are happy that the world can't edit your maps, then enable the
            editor. This is done by editing the top of editor.php and changing
            <code>$ENABLED=false;</code> to <code>$ENABLED=true;</code></p>

            <p>
            You should now be able to go to
            http://your.server/cacti/plugins/weathermap/editor.php in a browser, and get
            a welcome page that offers to load or create a config file. That's it. All
            done. Please see the
            <a href = "editor.html">editor manual page</a> for more about
            <i>using</i> the editor!
            </p>

            <p>You can also edit an existing map from the Cacti web interface, by
            choosing Manage..Weathermaps and then clicking on the name of a config file
            in the list of active maps. The editor will open with that map loaded.</p>

            <p>
            <strong>Important Security Note:</strong> The editor allows
            <i>anyone</i> who can access editor.php to change the configuration files
            for your network weathermaps. There is no authentication built-in for
            editing, even with the Cacti Plugin. This is why the configuration file
            doesn't exist by default
            - the editor won't work until you choose to make it work. It's recommended
            that you either:

            <ul><li>change the ownership of configuration files so that the editor can't
            write to them once they are complete, or </li><li>use your webserver's
            authentication and access control facilities to limit who can access the
            editor.php URL. On apache, this can be done using the FilesMatch directive
            and mod_access.</li>
            </ul>
            </p>

<?php
        include "common-page-foot.php";
