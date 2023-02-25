{{-- user info and avatar --}}
<div class="avatar av-l chatify-d-flex" style="background-image: url('');"></div>
<p class="info-name">{{ config('chatify.name') }}</p>
<h5 style="display: flex;
    justify-content: center;
    margin-top: 20px;
    font-size: 15px;">Owner of</h5>
<hr style="margin: 0 10% 0 10%;">
<h6 class="info-page" style="
    display: flex;
    justify-content: center;
    font-size: 12px;
    margin: 4% 12% 4% 12%;
    text-align: center;"></h6>
<div class="messenger-infoView-btns">
    {{-- <a href="#" class="default"><i class="fas fa-camera"></i> default</a> --}}
{{--    <a href="#" class="danger delete-conversation"><i class="fas fa-trash-alt"></i> Delete Conversation</a>--}}
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title">shared photos</p>
    <div class="shared-photos-list"></div>
</div>
