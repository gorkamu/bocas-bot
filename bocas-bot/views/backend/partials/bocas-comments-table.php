<table class="wp-list-table widefat fixed striped comments">
    <thead>
    <tr>
        <th scope="col" id="author" class="manage-column column-author" style="width: 18%"><span>Author</span></th>
        <th scope="col" id="comment" class="manage-column column-comment">Comment</th>
        <th scope="col" id="response" class="manage-column column-response"><span>In reply to</span></th>
        <th scope="col" id="date" class="manage-column column-date"><span>Submitted on</span></th>
        <th scope="col" id="status" class="manage-column column-date"><span>Status</span></th>
    </tr>
    </thead>
    <tbody id="the-comment-list" data-wp-lists="list:comment">
    <?php
    if(isset($comments) && !is_null($comments)) {
        foreach($comments as $key => $value) {

            ?>
            <tr id="comment-<?php echo esc_html($value->comment_ID); ?>" class="comment even thread-even depth-1 approved">
                <td class="author column-author" data-colname="Autor">
                    <strong>
                        <img alt=""
                             src="http://0.gravatar.com/avatar/36599ddecac54011bd670626bacf745a?s=32&amp;d=mm&amp;r=g"
                             srcset="http://0.gravatar.com/avatar/36599ddecac54011bd670626bacf745a?s=64&amp;d=mm&amp;r=g 2x"
                             class="avatar avatar-32 photo" height="32" width="32"/>
                        <?php echo esc_html($value->comment_author); ?>
                    </strong>
                    <br>
                    <a target="_blank" href="<?php echo esc_html($value->comment_author_url); ?>"><?php echo esc_html($value->comment_author_url); ?></a>
                    <br>
                    <a><?php echo esc_html($value->comment_author_email); ?></a>
                    <br>
                    <a><?php echo esc_html($value->comment_author_IP); ?></a>
                </td>

                <td class="comment column-comment has-row-actions column-primary" data-colname="Comment">
                    <p><?php echo esc_html($value->comment_content); ?></p>
                </td>

                <td class="response column-response" data-colname="En respuesta a">
                    <div class="response-links">
                        <a href="/wp-admin/post.php?post=<?php echo esc_html($value->ID); ?>&action=edit" class="comments-edit-item-link"><?php echo esc_html($value->post_title); ?></a>
                        <a href="<?php echo esc_html($value->guid); ?>" class="comments-view-item-link">Ver entrada</a>
                    </div>
                </td>

                <td class="date column-date" data-colname="Submitted on">
                    <div class="submitted-on">
                        <a href="<?php echo esc_html($value->guid); ?>#comment-<?php echo esc_html($value->comment_ID); ?>" target="_blank"><?php echo explode(" ", esc_html($value->comment_date))[0]; ?></a>
                    </div>
                </td>

                <td class="date column-date" data-colname="Submitted on">
                    <div class="status">
                        <?php echo (intval($value->comment_approved) === 0) ? 'Awaiting' : 'Approved'; ?>
                    </div>
                </td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>