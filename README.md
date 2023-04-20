README
# Protect Events

Build and start

```bash
make build
```

## Tests

```bash
make test
```

## Usage examples

Push a new event (using httpie):

```bash
$ http PUT localhost:8031/event --raw '{
    "user_id": "5b0c4496-f678-4a2d-a6b2-8c367f4e2c5c",
    "name": "invoice_due",
    "metadata": {
        "payment_status": "done"
    }
}'
...
200 OK
x-event-id: d69477bf-22f6-4f4b-a8b0-a003f2fc0d40
{
    "user_id": "5b0c4496-f678-4a2d-a6b2-8c367f4e2c5c",
    "name": "invoice_due",
    "metadata": {
        "payment_status": "done"
    }
}
```
