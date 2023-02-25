<div class="favorite-list-item">
{{--    @if($userInfo->user_type === "Tourist")--}}
{{--        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"--}}
{{--             style="background-image: url('{{ $userInfo->user_picture }}');">--}}
{{--        </div>--}}
{{--        <p>{{ strlen($userInfo->user_fname) > 5 ? substr($userInfo->user_fname,0,6).'..' : $userInfo->user_fname }}</p>--}}
{{--    @elseif($userInfo->user_type === "Owner")--}}
{{--        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"--}}
{{--             style="background-image: url('{{ $userInfo->dest_main_picture }}');">--}}
{{--        </div>--}}
{{--        <p>{{ strlen($userInfo->dest_name) > 5 ? substr($userInfo->dest_name,0,6).'..' : $userInfo->dest_name }}</p>--}}
{{--    @elseif($userInfo->user_type === "Tour Operator")--}}
{{--        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"--}}
{{--             style="background-image: url('{{ $userInfo->operator_main_picture }}');">--}}
{{--        </div>--}}
{{--        <p>{{ strlen($userInfo->operator_company) > 5 ? substr($userInfo->operator_company,0,6).'..' : $userInfo->operator_company }}</p>--}}
{{--    @endif--}}
    <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m" style="background-image: url('{{ asset($userInfo->user_picture) }}');">
    </div>
    <p>{{ strlen($userInfo->user_fname) > 5 ? substr($userInfo->user_fname,0,6).'..' : $userInfo->user_fname }}</p>
</div>
