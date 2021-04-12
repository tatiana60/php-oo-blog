<?php

$categories = $categoryRepository->findAll();
$authors = $authorRepository->findAll();

?>

<div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Titre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $post->getTitle() ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Catégorie</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="category" name="category">
                            <option value="">Choisir</option>
                            <?php
                            foreach ($categories as $category) {
                            	$selected = '';
                            	if(null !== $c = $post ->getCategory()) {
                            		if($c->getId() === $category->getId()){
                            			$selected = 'selected';
                            		}
                            	}
                                ?>
                                <option value="<?= $category->getId() ?>" <?php echo $selected ?>><?= $category->getTitle() ?></option><?php
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="author" class="col-sm-2 col-form-label">Auteur</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="author" name="author">
                            <option value="">Choisir</option>
                            <?php
                            foreach ($authors as $author) {
                            	$selected = '';
                            	if(null !== $a = $post ->getAuthor()) {
                            		if($a->getId() === $author->getId()){
                            			$selected = 'selected';
                            		}
                            	}
                                ?>
                                <option value="<?= $author->getId() ?>" <?php echo $selected ?>><?= $author->getName() ?></option><?php
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-sm-2 col-form-label">Contenu</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="content" name="content"><?= $post->getContent() ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date" value="<?php 
                        if($post->getDate() !== null){

                        echo $post->getDate()->format('Y-m-d'); 

                    	}
                        ?>">
                    </div>
                </div>
