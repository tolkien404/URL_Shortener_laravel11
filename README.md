# URL_Shortener_laravel11

## SIMPLE SHORTENER

### Tambahkan event pada database

```mysql
CREATE EVENT delete_expired_rows
    ON SCHEDULE EVERY 1 DAY
        STARTS CURRENT_DATE + INTERVAL 1 DAY
    DO
    DELETE
    FROM urls
    WHERE expires_at < NOW()
      AND expires_at IS NOT NULL;
```

ketika link melebihi waktu expires akan terhapus sendiri.
