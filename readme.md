# historical data crawler

a crawler to fetch crypto historical data from coinmarketcap and save to a csv file

## how to use

save history data for one coin, if without time arguments, save data of the last 30 days

```php
php saveCryptoHistoryData coinmarketcap:history:csv ripple 20180101 20180201
```

save history data for all coins

```php
php saveCryptoHistoryData coinmarketcap:history:csv:all 20180101 20180201
```
