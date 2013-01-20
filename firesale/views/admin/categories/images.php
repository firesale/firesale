                    <fieldset>
                        <div id="dropbox">
                        <?php echo ( count($images) > 0 ? '' : '	<span class="message">' . lang('firesale:label_drop_images') . '</span>' ); ?>
                        <?php foreach($images as $image): ?>
                            <div class="preview" id="image-<?php echo $image->id; ?>">
                                <span class="imageHolder">
                                    <a href="{{ url:site }}admin/firesale/products/delete_image/<?php echo $image->id; ?>" class="delete">x</a>
                                    <img src="{{ url:site }}files/thumb/<?php echo $image->id; ?>/480/360" />
                                </span>
                                <span class="imageTitle"><?php echo $image->name; ?></span>
                            </div>
                        <?php endforeach; ?>
                            <br class="clear" />
                        </div>
                    </fieldset>
