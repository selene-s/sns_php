<?php

function h($s){
	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/*
データを表示する際にエスケープするための関数　PHPを使用する上で必須
htmlspecialchars() という長めの命令を使うので、h() で代替。


【htmlspecialchars()とは？】
HTMLのエンティティ化を行う（エスケープ処理）
エンティティ化とは、>（大なり）や""（ダブルクォート）など、特殊な意味を持つ特殊文字を、特殊な意味を持たない単なる文字列に変換すること。
フォームなどでユーザーが悪意のあるスクリプトを送信しようとするのを防いでくれたりするので、セキュリティ上でも必須。

【フラグ】
ENT_QUOTES を指定することで、下記にようなエスケープを行う。

「”」(ダブルクォート)が「&quot;」に変換されます。
「’」(シングルクォート)が「&#039;」または「&apos;」に変換されます。
「<」が「&lt;」に変換されます。
「>」が「&gt;」に変換されます。

エンコード　 　UTF-8など

例）
<p>
あなたの名前は <?php echo htmlspecialchars($fullName, ENT_QUOTES, "UTF-8"); ?> ですね。<br>
</p>

↓↓↓

// h関数で($s)変数
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}　 
<p>
あなたの名前は <?php echo h($fullName); ?> ですね。<br>
</p>
*/



