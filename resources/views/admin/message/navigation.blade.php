<div class="box">
    <a href="{{ url('/admin/'.$objectName.'/add') }}" class="btn btn-primary full"><i class="fa fa-pencil"></i> Compose</a>
    <ul class="message-navigation">
        <a href="{{ url('/admin/'.$objectName) }}" class="<?php echo ($on=='inbox') ? 'active' : ''; ?>"><li><i class="fa fa-envelope"></i> inbox</li></a>
        <a href="{{ url('/admin/'.$objectName.'/sent') }}" class="<?php echo ($on=='sent') ? 'active' : ''; ?>"><li><i class="fa fa-telegram"></i> sent</li></a>
        <a href="{{ url('/admin/'.$objectName.'?is_deleted=1') }}" class="<?php echo ($on=='trash') ? 'active' : ''; ?>"><li><i class="fa fa-trash"></i> trash</li></a>
    </ul>
</div>