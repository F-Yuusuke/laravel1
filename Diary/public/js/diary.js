// いいねした時に画面遷移せずにいいねが増えて色が変わるようにするためのコード


$(document).on('click', '.js-like', function() {
    console.log('ボタンがクリックされました。');

    // １今クリックされたボタンがどんなものかを取得した diary-idをの取得を忘れずに
    let $clickedBtn = $(this);
    let diaryId = $(this).siblings('.diary-id').val();


    like(diaryId, $clickedBtn);
});

// ２likeの関数を作る
function like(diaryId, $clickedBtn){
    // ３画面遷移しないいいねの増やし方の設定をここに書く どこのページにデータを送るか 
    $.ajax({
        // ４それぞれのdiaryidを取得 変数にしないと同じidしか取れないから${}で囲んで変数にしている
        url: `diary/${diaryId}/like`,
        // ５情報を取得しないと更新できないからpost
        type: 'POST',
        // ６データを取得する方法がjson
        dataType: 'json', 

        //７ LaravelではCSRF対策として、tokenを送信しないとエラーが発生します。絶対書く事
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    // その後にどんな処理（動き）をするか
    .then(
        function (data) {
        // ９ データの送受信が成功したら処理してください
            changeLikeBtn($clickedBtn);

        // １０いいね数を1増やす フォントアンセムのアイコンと同じ列にいるものと区別するためにsiblings('.js-like-num')
        // と書いて情報を取得 フォントアンセムのボタンをクリックされたら数字を１ずつ足していく
        let num = Number($clickedBtn.siblings('.js-like-num').text());
        $clickedBtn.siblings('.js-like-num').text(num + 1);
        },
        function () {
            console.log(error);
        }
    )
}

// ８先に関数を作る  いいねしたり解除したりできる ボタンの色を変更
// js-like, js-dislikeでいいね, いいね解除の切り替えをしてるためクラスの付け替え
function changeLikeBtn(btn) {
    btn.toggleClass('far').toggleClass('fas');
    btn.toggleClass('js-like').toggleClass('js-dislike');
}

