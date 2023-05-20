@extends('layouts.line')
@section('content')

    <div class="center">
        <label for="line">
            <input type="radio" class="radio" id="line" name="category_id" onchange="showCategory(this)"
                value="line" checked>line
        </label>
        <label for="email">
            <input type="radio" class="radio" id="email" name="category_id" onchange="showCategory(this)"
                value="email">email
        </label>
    </div><br>
    <div>
        <div id="line" class="center sort">
            <p>公式Lineアカウント友達追加用QRコード</p>
            <div class="line">
                <img src="https://qr-official.line.me/gs/M_973orjiy_GW.png" width="200" height="200"><br>
            </div><br>

            <form class="border" method="POST" action="line">
                @csrf
                <div>
                    <!-- <label for="line_user_id">Line User ID:</label> -->
                    <p>Line UserIDの登録</p>
                    <input type="search" class="clear" name="line_user_id" id="line_user_id" required placeholder="Line User IDを入力">
                    <p>LINE利用者の登録</p>
                    <input type="search" class="clear" id="line_user_name" name="line_user_name" required placeholder="登録者情報を入力">
                </div><br>
                <button type="submit">登録</button>
            </form><br>

            <!-- <form method="POST" action="line/enable">
                            @csrf
                            <label>状態を変更するLine User IDを選択</label>
                            <br>
                            @foreach ($lines as $id => $line)
    <input type="radio" name="line_id" value="{{ $id }}" required> {{ $line }}:
                            <input type="radio" name="enable" value="true" checked> 有効
                            <input type="radio" name="enable" value="false"> 無効
                            <br>
    @endforeach
                            <br>
                            <button type="submit">変更</button>
                        </form> -->

            @if (count($lines) > 0)
                <form class="border" method="POST" action="line">
                    @csrf
                    @method('PUT')
                    <table class="table">
                        <tr>
                            <th class="border">LINEユーザーID</th>
                            <th class="border">LINE利用者</th>
                            <th class="border">通知状況</th>
                        </tr>
                        @foreach ($lines as $line)
                            <tr>
                                <td class="border">
                                    <input type="radio" name="line_id" value="{{ $line->id }}"
                                        required>{{ $line->line_user_id }}
                                    <!-- <input type="text" id="line_name" name="line_name" required value="{{ $line->line_user_name }}" placeholder="登録者情報を登録" data-value="{{ $line->line_user_name }}"><br> -->
                                </td>

                                <td class="border">
                                    {{ $line->line_user_name }}
                                </td>

                                <td class="border">
                                    @if ($line->enable == 1)
                                        有効
                                    @elseif($line->enable == 0)
                                        無効
                                    @endif
                                </td>
                            </tr>
                            <br>
                        @endforeach
                    </table>
                    <br>
                    <li>上記で選んだIDの通知を有効にするか無効にするか選んでね</li>
                    <input type="radio" name="enable" value="true" required> 有効
                    <input type="radio" name="enable" value="false" required> 無効
                    <br>
                    <br>
                    <button type="submit">通知更新</button>
                </form><br>
            @endif

            @if (count($lines) > 0)
                <form class="border" method="POST" action="line">
                    @csrf
                    @method('DELETE')
                    <label>削除するLineユーザーIDを選択</label>
                    <br>
                    @foreach ($lines as $line)
                        <input type="radio" name="line_id" value="{{ $line->id }}" required> {{ $line->line_user_id }}
                        <br>
                        <!-- <input type="radio" name="enable" value="1" checked> オン
                            <input type="radio" name="enable" value="0"> オフ<br> -->

                        {{-- <input type="radio" name="line_id" value="{{ $id }}"> {{ $line->line_user_id }}<br> 左だとダメ --}}
                    @endforeach
                    <br>
                    <button type="submit">削除</button>
                </form><br>
            @else
                <p>現在LineユーザーIDの登録はありません。</p>
            @endif

        </div>
    </div>


    <div id="email" class="center sort">

        <form class="border" method="POST" action="line">
            @csrf
            <div>
                <!-- <label for="line_user_id">Line User ID:</label> -->
                <p>通知メールの追加登録(ログイン時のメールアドレスは通知オン固定)</p>
                <input type="search" class="clear" name="email" id="email" required placeholder="メールアドレスを入力">
            </div><br>
            <button type="submit">登録</button>
        </form><br>

        <!-- <form method="POST" action="line/enable">
                            @csrf
                            <label>状態を変更するLine User IDを選択</label>
                            <br>
                            @foreach ($lines as $id => $line)
    <input type="radio" name="line_id" value="{{ $id }}" required> {{ $line }}:
                            <input type="radio" name="enable" value="true" checked> 有効
                            <input type="radio" name="enable" value="false"> 無効
                            <br>
    @endforeach
                            <br>
                            <button type="submit">変更</button>
                        </form> -->

        @if (count($mails) > 0)
            <form class="border" method="POST" action="line">
                @csrf
                @method('PUT')
                <table class="table">
                    <tr>
                        <th class="border">メールアドレス</th>
                        <th class="border">通知状況</th>
                    </tr>
                    @foreach ($mails as $mail)
                        <tr>
                            <td class="border">
                                <input type="radio" name="mail" value="{{ $mail->id }}"
                                    required>{{ $mail->email }}
                                <!-- <input type="text" id="line_name" name="line_name" required value="{{ $line->line_user_name }}" placeholder="登録者情報を登録" data-value="{{ $line->line_user_name }}"><br> -->
                            </td>
                            <td class="border">
                                @if ($mail->enable == 1)
                                    有効
                                @elseif($mail->enable == 0)
                                    無効
                                @endif
                            </td>
                        </tr>
                        <br>
                    @endforeach
                </table>
                <br>
                <li>上記選択したメールアドレスの通知オン/オフ選択</li>
                {{-- <label for="on"> --}}
                    <input type="radio" name="enable" value="true" required> 有効
                    <input type="radio" name="enable" value="false" required> 無効
                {{-- </label> --}}

                <br>
                <br>
                <button type="submit">通知更新</button>
            </form><br>
        @endif

        @if (count($mails) > 0)
            <form class="border" method="POST" action="line">
                @csrf
                @method('DELETE')
                <label>削除するメールアドレスを選択</label>
                <br>
                @foreach ($mails as $mail)
                    <input type="radio" name="line_id" value="{{ $mail->id }}" required>
                    {{ $mail->email }}
                    <br>
                    <!-- <input type="radio" name="enable" value="1" checked> オン
                            <input type="radio" name="enable" value="0"> オフ<br> -->

                    {{-- <input type="radio" name="line_id" value="{{ $id }}"> {{ $line->line_user_id }}<br> 左だとダメ --}}
                @endforeach
                <br>
                <button type="submit">削除</button>
            </form><br>
        @else
            <p>現在追加メールアドレスの登録はありません。</p>
        @endif

    </div>


@endsection
