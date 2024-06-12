# ShiftPilot
 シフト管理アプリです。<br >
 スタッフから希望シフトを収集し、それを元にシフト作成・共有ができます。 <br >
 レスポンシブ対応しているのでスマホからもご確認いただけます。
 <!-- <img width="1400" alt="スクリーンショット 2020-05-07 0 06 18" src="https://user-images.githubusercontent.com/60876388/81193748-c51d9b00-8ff6-11ea-9981-46789f016300.png">
 <img width="350" height="700" src= "https://user-images.githubusercontent.com/60876388/81476543-643bd000-924d-11ea-9d26-cac305ca9f91.jpeg"> -->

# URL
http://shiftpilot-1391980858.us-east-1.elb.amazonaws.com/ <br >

# 使用技術
- PHP 8.2.0
- Laravel 10
- MySQL 8.0
- Apache
- AWS
  - VPC
  - ECR on Fargate
  - RDS
- Docker/Docker-compose

<!--
※以下、要更新
# AWS構成図
<img width="995" alt="スクリーンショット 2020-05-07 11 14 01" src="https://user-images.githubusercontent.com/60876388/81247155-3ccde300-9054-11ea-91eb-d06eb38a63b3.png">

## CircleCi CI/CD
- Githubへのpush時に、RspecとRubocopが自動で実行されます。
- masterブランチへのpushでは、RspecとRubocopが成功した場合、EC2への自動デプロイが実行されます
-->

# 機能一覧
- ユーザー登録、ログイン機能
- シフト提出機能
- シフト作成機能
  - 下書き機能
  - 確定機能
- シフト締切のリマインド機能
- スタッフ管理機能
  - スタッフ登録機能
  - スタッフ削除機能
- ページネーション機能
- お問い合わせ機能

<!--
# テスト
- RSpec
  - 単体テスト(model)
  - 機能テスト(request)
  - 統合テスト(feature)
-->
