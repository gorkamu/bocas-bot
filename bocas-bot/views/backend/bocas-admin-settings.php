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
                <br>

                <div class="panel panel-default bocas-background-color-panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="admin-post.php" class="form-inline">
                                    <input type="hidden" name="action" value="bocas_admin_add_profile" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-5">
                                                <label for="name">Profile:</label>
                                                <select class="form-control" name="profile" id="profile">
                                                    <option value=""
                                                            data-profile-id=""
                                                            data-profile-name=""
                                                            data-profile-author=""
                                                            data-profile-email=""
                                                            data-profile-web=""
                                                            data-profile-content=""> -- </option>
                                                    <?php
                                                    if(isset($profiles) && !is_null($profiles)) {
                                                        foreach($profiles as $profile) {
                                                            ?>
                                                            <option value="<?php echo esc_html($profile->id); ?>"
                                                                    data-profile-id="<?php echo esc_html($profile->id); ?>"
                                                                    data-profile-name="<?php echo esc_html($profile->name); ?>"
                                                                    data-profile-author="<?php echo esc_html($profile->author); ?>"
                                                                    data-profile-email="<?php echo esc_html($profile->email); ?>"
                                                                    data-profile-web="<?php echo esc_html($profile->web); ?>"
                                                                    data-profile-content="<?php echo esc_html($profile->content); ?>"
                                                            ><?php echo esc_html($profile->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label for="name">Profile name:</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="#1 Profile" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="author">Author:</label>
                                                <input type="text" class="form-control" id="author" name="author" placeholder="jane.doe@example.com" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email">Email:</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="jane.doe@example.com" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-4">
                                                <label for="web">Web:</label>
                                                <input type="text" class="form-control" id="web" name="web" placeholder="http://gorkamu.com" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="date">Content:</label>
                                                <textarea class="form-control" rows="3" cols="120" name="content" id="content" required></textarea>
                                            </div>
                                            <br><br>
                                            <span>The <i>name, email, web and content</i> field could be used with <a
                                                        href="http://gorkamu.com/2018/10/como-spinear-un-texto/#Spintax_anidado_o_en_3_dimensiones" target="_blank">spintax 3d format</a> too.</span>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <button class="btn btn-danger bocas-delete-profile" style="display:none">Delete profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
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
                            <th></th>
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
                                    <td><span class="dashicons dashicons-trash bocas-trash" data-id="<?php echo esc_html($value->id); ?>"></span</td>
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
                <div class="col-row">
                    <div class="col-md-10 col-md-offset-1" style="margin-top: 5%;">
                        <img src="<?php echo esc_url( plugins_url( '../assets/img/bocas.png', __FILE__ ) ); ?>" alt="bocas wp bot" class="alignright bocas_logo" style="width:20%"/>
                        <p><b>Thanks for use Bocas Bot v<?php echo BOCAS_BOT__VERSION; ?>!!</b></p>
                        <p>This plugin allows you manage your own auto scheduled fake comments.</p>
                        <br>
                        <p>You can schedule your own comments to improve your SEO on page</p>
                        <p>The content for the different plugin's fields accepts text in spintax format and spintax 3d format. </p>
                        <p>For more info visit <a href="http://gorkamu.com/2018/10/como-spinear-un-texto/" target="_blank">this link</a>.</p>
                        <br>
                        <p>You are able to schedule a huge amount of comments through Bocas Bot.</p>
                        <p>To know all the features in detail just visit this manual -></p>
                        <br>
                        <p>Thanks for download and installing this plugin.</p>
                        <p>If you want report some bug you can do it through the official <a href="https://gitlab.com/gorkamu/bocas-bot">repository page</a>.</p>
                        <p>This plugin is in a first version state.</p>
                        <p>All the feedback will be welcome.</p>
                        <br>
                        <p><a href="https://twitter.com/gorkakatua" target="_blank" rel="nofollow">@gorkakatua</a></p>
                        <p><a href="http://gorkamu.com" target="_blank">http://gorkamu.com</a></p>
                        <p><a href="https://gitlab.com/gorkamu/bocas-bot" target="_blank">https://gitlab.com/gorkamu/bocas-bot</a></p>
                        <br>
                        <p><h4 style="text-align: center;">New features are comming!</h4></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>