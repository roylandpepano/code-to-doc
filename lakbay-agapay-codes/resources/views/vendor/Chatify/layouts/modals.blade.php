{{-- ---------------------- Image modal box ---------------------- --}}
<div id="imageModalBox" class="imageModal">
    <span class="imageModal-close">&times;</span>
    <img class="imageModal-content" id="imageModalBoxSrc">
</div>

{{-- ---------------------- Delete Modal ---------------------- --}}
<div class="app-modal" data-name="delete">
  <div class="app-modal-container">
      <div class="app-modal-card" data-name="delete" data-modal='0'>
          <div class="app-modal-header">Are you sure you want to delete this?</div>
          <div class="app-modal-body">You can not undo this action</div>
          <div class="app-modal-footer">
              <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
              <a href="javascript:void(0)" class="app-btn a-btn-danger delete">Delete</a>
          </div>
      </div>
  </div>
</div>
{{-- ---------------------- Alert Modal ---------------------- --}}
<div class="app-modal" data-name="alert">
  <div class="app-modal-container">
      <div class="app-modal-card" data-name="alert" data-modal='0'>
          <div class="app-modal-header"></div>
          <div class="app-modal-body"></div>
          <div class="app-modal-footer">
              <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
          </div>
      </div>
  </div>
</div>
{{-- ---------------------- Settings Modal ---------------------- --}}
<div class="app-modal" data-name="settings">
  <div class="app-modal-container">
      <div class="app-modal-card" data-name="settings" data-modal='0'>
          <form id="update-settings" action="{{ route('avatar.update') }}" enctype="multipart/form-data" method="POST">
              @csrf
               <div class="app-modal-header">Customize your settings</div>
              <div class="app-modal-body">
                  {{-- Dark/Light Mode  --}}
                  <p class="divider"></p>
                  <p class="app-modal-header">Dark Mode <span class="
                    {{ Auth::user()->dark_mode > 0 ? 'fas' : 'far' }} fa-moon dark-mode-switch"
                     data-mode="{{ Auth::user()->dark_mode > 0 ? 1 : 0 }}"></span></p>
                  {{-- change messenger color  --}}
                  <p class="divider"></p>
                  {{-- <p class="app-modal-header">Change {{ config('chatify.name') }} Color</p> --}}
                  <div class="update-messengerColor">
                  @foreach (config('chatify.colors') as $color)
                    <span style="background-color: {{ $color}}" data-color="{{$color}}" class="color-btn"></span>
                    @if (($loop->index + 1) % 5 == 0)
                        <br/>
                    @endif
                  @endforeach
                  </div>
              </div>
              <div class="app-modal-footer">
                  <a href="javascript:void(0)" class="app-btn cancel">Cancel</a>
                  <input type="submit" class="app-btn a-btn-success update" value="Save Changes" />
              </div>
          </form>
      </div>
  </div>
</div>
{{-- ---------------------- Pages Owned Modal ---------------------- --}}
<div class="app-modal" data-name="pages">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="pages" data-modal='0'>
             <div class="app-modal-header">
                 <h5>Pages Owned by this User</h5>
                 <hr>
             </div>
            <div class="app-modal-body">
                <div>
{{--                    @php--}}
{{--                        // LINK Method - doesn't refresh--}}
{{--                        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";--}}
{{--                        $split = explode('/', $link);--}}
{{--                        $userID = end($split);--}}

{{--                        $noID = "";--}}

{{--                        if($userID==="chatify"){--}}
{{--                            $noID = "No";--}}
{{--                        }else{--}}
{{--                            $noID = "Yes";--}}
{{--                            $pages = \App\Models\Destination::join('users', 'destinations.user_id', '=', 'users.id')--}}
{{--                            ->select('destinations.*', 'users.*')--}}
{{--                            ->where('destinations.user_id', $userID)--}}
{{--                            ->get();--}}
{{--                        }--}}
{{--                    @endphp--}}
{{--                    <span>--}}
{{--                        @if($noID==="Yes")--}}
{{--                            @foreach($pages as $page)--}}
{{--                                {{ $page->dest_name }}--}}
{{--                                --}}{{--                            <button class="btn btn-primary btn-small">Go</button>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            <span>No Owned Pages</span>--}}
{{--                        @endif--}}
{{--                    </span>--}}
                    <span class="pages-owned"></span>
                </div>
            </div>
            <div class="app-modal-footer">
                <hr>
                <a href="javascript:void(0)" class="app-btn close">Close</a>
            </div>
        </div>
    </div>
</div>
