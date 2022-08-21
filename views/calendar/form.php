
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Titre</label>
                    <input id="name" type="text" class="form-control" name="name" value="<?=
                    isset($data['name'])? h($data['name']): '' ; ?>" required>
                    
                    <?php  if(isset($errors['name']) ): ?>
                        <small class="form-text"><?php $errors['name']; ?></small>
                    <?php endif;  ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input id="date" type="date" class="form-control" name="date" required value="<?=
                    isset($data['date'])? h($data['date']): '' ; ?>">
                    <?php  if(isset($errors['date']) ): ?>
                        <small class="form-text"><?php $errors['date']; ?></small>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="start">Démarage</label>
                    <input id="start" type="time" class="form-control" name="start" placeholder="HH:MM" required value="<?=
                    isset($data['start'])? h($data['start']): '' ; ?>">
                    <?php  if(isset($errors['start']) ): ?>
                        <small class="form-text"><?php $errors['start']; ?></small>
                    <?php endif;  ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="end">Fin</label>
                    <input id="end" type="time" class="form-control" name="end" placeholder="HH:MM" required value="<?=
                    isset($data['end'])? h($data['end']): '' ; ?>">
                    <?php  if(isset($errors['end']) ): ?>
                        <small class="form-text"><?php $errors['end']; ?></small>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" "<?=
                    isset($data['description'])? h($data['description']): '' ; ?>"></textarea>
        </div>
       