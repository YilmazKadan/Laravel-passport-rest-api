# Laravel Passport Rest API 

Bu projede Laravel ve Laravel'in Passport paketini kullanarak mobil veya farklı platformalarda kullanılmak üzere bir rest API projesi oluşturulmuştur.

## Neler var

Proje içerisinde kullanıcı oluşturma, kullanıcı bilgisine erişme, şifremi unuttum maili yollama ve token ile şifre sıfırlama vb. özellikler bulunmaktadır.

## Proje kurulumu
Projeyi elde ettiken sonra `composer install` komutu ile tüm bağımlılıkları yüklüyoruz.
`php artisan key:generate` komutu ile uygulama anahtarı oluşturulmalıdır.
Bu anahtar session ve diğer şifrelenmiş verilerin güvenliğinde kullanılacaktır.
key oluştuktan sonra .env dosyanız oluşacaktır.
.env dosyanıza veritabanı ayarlamasını aşağıdaki gibi yapmanız gerekiyor.

<pre>
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_SERVICE_NAME=servis adınız
DB_USERNAME=OracleDb kullanıcı adı
DB_PASSWORD=db şifreniz
</pre>
Ardından
Bu işlemlerden sonra migration dosyalarını veritabanına geçirmek için
<pre> php artisan migrate 
</pre> komutunu konsola yazıyoruz.

Projeyi ayağa kaldırmak için yazmanız gereken kod: `php artisan serve`

Başlangıç için bir admin ve user hesabı oluşmuş olacaktır. Bunları daha sonra kaldırabilirsiniz.
