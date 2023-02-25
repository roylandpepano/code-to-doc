{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item m-li-divider" data-contact="{{ Auth::user()->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="avatar av-m" style="background-color: #d9efff; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <span class="far fa-bookmark" style="font-size: 22px; color: #68a5ff;"></span>
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ Auth::user()->id }}" data-type="user">Saved Messages <span>You</span></p>
                <span>Save messages secretly</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- All users/group list -------------------- --}}
@if($get == 'users')
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            @php
//                if($user->user_type === "Tourist"){
//                    $info = \App\Models\User::select('user_fname', 'user_lname', 'user_type', 'user_picture')
//                        ->where('users.id', $user->id)
//                        ->first();
//                }elseif($user->user_type === "Owner"){
//                    $info = \App\Models\Destination::join('users', 'destinations.user_id', '=', 'users.id')
//                        ->select('destinations.dest_name', 'destinations.dest_main_picture', 'users.user_type')
//                        ->where('destinations.user_id', $user->id)
//                        ->first();
//                }elseif($user->user_type === "Tour Operator"){
//                    $info = \App\Models\TourOperator::join('users', 'tour_operators.user_id', '=', 'users.id')
//                        ->select('tour_operators.operator_company', "tour_operators.operator_main_picture", 'users.user_type')
//                        ->where('tour_operators.user_id', $user->id)
//                        ->first();
//                }
                $info = \App\Models\User::select('user_fname', 'user_lname', 'user_type', 'user_picture')
                            ->where('users.id', $user->id)
                            ->first();
            @endphp
            <td style="position: relative">
                @if($user->active_status)
                    <span class="activeStatus"></span>
                @endif
                <div class="avatar av-m" style="background-image: url('{{ asset($info->user_picture) }}');">
{{--                     @if($info->user_type === "Tourist")--}}
{{--                         style="background-image: url('{{ $info->user_picture }}');">--}}
{{--                    @elseif($info->user_type === "Owner")--}}
{{--                        style="background-image: url('{{ $info->dest_main_picture }}');">--}}
{{--                    @elseif($info->user_type === "Tour Operator")--}}
{{--                        style="background-image: url('{{ $info->operator_main_picture }}');">--}}
{{--                    @endif--}}
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user">
                    {{ $info->user_fname }} {{ $info->user_lname }}
{{--                    @if($info->user_type === "Tourist")--}}
{{--                        {{ $info->user_fname }} {{ $info->user_lname }}--}}
{{--                    @elseif($info->user_type === "Owner")--}}
{{--                        {{ $info->dest_name }}--}}
{{--                    @elseif($info->user_type === "Tour Operator")--}}
{{--                        {{ $info->operator_company }}--}}
{{--                    @endif--}}
                    <span>{{ $lastMessage->created_at->diffForHumans() }}</span></p>
                <span>
            {{-- Last Message user indicator --}}
                    {!!
                        $lastMessage->from_id == Auth::user()->id
                        ? '<span class="lastMessageIndicator">You :</span>'
                        : ''
                    !!}
                    {{-- Last message body --}}
                    @if($lastMessage->attachment == null)
                        {!!
                            strlen($lastMessage->body) > 30
                            ? trim(substr($lastMessage->body, 0, 30)).'..'
                            : $lastMessage->body
                        !!}
                    @else
                        <span class="fas fa-file"></span> Attachment
                    @endif
        </span>
                {{-- New messages counter --}}
                {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
            </td>

        </tr>
    </table>
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
    <table class="messenger-list-item" data-contact="{{ $user->id }}">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
                <div class="avatar av-m"
                     style="background-image: url('{{ $user->user_picture }}');">
                </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ $user->id }}" data-type="user">
                {{ strlen($user->user_fname) > 12 ? trim(substr($user->user_fname,0,12)).'..' : $user->user_fname }}
            </td>

        </tr>
    </table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
    <div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif

