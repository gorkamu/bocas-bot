<div class="wrap">
    <div class="container theme-showcase" role="main">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#user_agents" data-toggle="tab">User Agents</a></li>
            <li><a href="#profiles" data-toggle="tab">Profiles</a></li>
            <li><a href="#about" data-toggle="tab">About</a></li>
        </ul>

        <div class="tab-content">
            <div id="profiles" class="tab-pane fade ">
                <h3>Profiles</h3>
            </div>

            <div id="user_agents" class="tab-pane fade in active">
                <h3>User Agents</h3>
                <br>
                <form method="post" action="admin-post.php" class="form-inline">
                    <input type="hidden" name="action" value="bocas_admin_add_user_agent" />
                    <div class="form-group mb-6">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="user_agent">User Agent:</label>
                        <input type="text" class="form-control" id="user_agent" name="user_agent" required>
                    </div>
                    <button type="submit" class="btn btn-success mb-2">Add new</button>
                </form>
                <br><br>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Agents</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($userAgents) && !is_null($userAgents)) {
                        foreach($userAgents as $key => $value) {
                            ?>
                                <tr>
                                    <td><?php echo esc_html($value->name); ?></td>
                                    <td><?php echo esc_html($value->user_agent); ?></td>
                                </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div id="about" class="tab-pane fade">
                <img src="<?php echo esc_url( plugins_url( '../assets/img/bocas_logo.png', __FILE__ ) ); ?>" alt="bocas wp bot" class="alignright bocas_logo" style="width:20%"/>
                <p>This plugin allows you manage your own auto scheduled fake comments.</p>
                <br>
                <p>Exists two different ways to insert your own comments.</p>
                <p>You can schedule one single comment going to the "Add comment" page. In that page you have to fill the form and submit the data.</p>
                <p>The content field accepts text in spintax format. For more info visit <a href="http://gorkamu.com/2018/10/como-spinear-un-texto/" target="_blank">this link</a>.</p>
                <br>
                <p>The other way to schedule the comments is making a massive load.</p>
                <p>You are able to schedule a huge amount of comments going to the "Bulk comments" page.</p>
                <p>In that page you have two options to schedule comments.</p>
                <p>The first option is filling the text-area with the required info and format.</p>
                <br>
                <p>The other option is loading a csv file. This csv file will be uploaded to your hosting and processed it. When it finish it will be removed. It's very simple.</p>
                <p>The system allows you load data with the both options. If you fill the bulk text-area and upload a csv file, the system will take this two data inputs and it will processed at the same time!</p>
                <br>
                <p>Thanks for download and installing this plugin. If you want report some bug or if you have any idea that could be developed don't doubt contact me through the social networks.</p>
                <p>This plugin is in the first Alpha version. All the feedback will be welcome.</p>
                <br>
                <p><a href="https://twitter.com/gorkakatua" target="_blank" rel="nofollow">@gorkakatua</a></p>
                <p><a href="http://gorkamu.com" target="_blank">http://gorkamu.com</a></p>
                <br>
                <p><h4 style="text-align: center;">New features are comming!</h4></p>
            </div>
        </div>
    </div>
</div>