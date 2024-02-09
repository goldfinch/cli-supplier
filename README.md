
# 🦅 CLI Supplier for Taz (Silverstripe)

[![Silverstripe Version](https://img.shields.io/badge/Silverstripe-5.1-005ae1.svg?labelColor=white&logoColor=ffffff&logo=data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDEuMDkxIDU4LjU1NSIgZmlsbD0iIzAwNWFlMSIgeG1sbnM6dj0iaHR0cHM6Ly92ZWN0YS5pby9uYW5vIj48cGF0aCBkPSJNNTAuMDE1IDUuODU4bC0yMS4yODMgMTQuOWE2LjUgNi41IDAgMCAwIDcuNDQ4IDEwLjY1NGwyMS4yODMtMTQuOWM4LjgxMy02LjE3IDIwLjk2LTQuMDI4IDI3LjEzIDQuNzg2czQuMDI4IDIwLjk2LTQuNzg1IDI3LjEzbC02LjY5MSA0LjY3NmM1LjU0MiA5LjQxOCAxOC4wNzggNS40NTUgMjMuNzczLTQuNjU0QTMyLjQ3IDMyLjQ3IDAgMCAwIDUwLjAxNSA1Ljg2MnptMS4wNTggNDYuODI3bDIxLjI4NC0xNC45YTYuNSA2LjUgMCAxIDAtNy40NDktMTAuNjUzTDQzLjYyMyA0Mi4wMjhjLTguODEzIDYuMTctMjAuOTU5IDQuMDI5LTI3LjEyOS00Ljc4NHMtNC4wMjktMjAuOTU5IDQuNzg0LTI3LjEyOWw2LjY5MS00LjY3NkMyMi40My0zLjk3NiA5Ljg5NC0uMDEzIDQuMTk4IDEwLjA5NmEzMi40NyAzMi40NyAwIDAgMCA0Ni44NzUgNDIuNTkyeiIvPjwvc3ZnPg==)](https://packagist.org/packages/goldfinch/cli-supplier)
[![Package Version](https://img.shields.io/packagist/v/goldfinch/cli-supplier.svg?labelColor=333&color=F8C630&label=Version)](https://packagist.org/packages/goldfinch/cli-supplier)
[![Total Downloads](https://img.shields.io/packagist/dt/goldfinch/cli-supplier.svg?labelColor=333&color=F8C630&label=Downloads)](https://packagist.org/packages/goldfinch/cli-supplier)
[![License](https://img.shields.io/packagist/l/goldfinch/cli-supplier.svg?labelColor=333&color=F8C630&label=License)](https://packagist.org/packages/goldfinch/cli-supplier) 

**CLI Supplier** is an extra interface for [**Taz**](https://github.com/goldfinch/taz)🌪️ commands that creates a bridge to communicate with Silverstripe core in CLI.

## Install

```bash
composer require goldfinch/cli-supplier
```

## Available Taz commands

If you haven't used [**Taz**](https://github.com/goldfinch/taz)🌪️ before, *taz* file must be presented in your root project folder `cp vendor/goldfinch/taz/taz taz`

---

> Create new CLI supplier
```bash
php taz make:cli-supplier
```

## Recommendation
This module plays nicely with mill factory [goldfinch/mill](https://github.com/goldfinch/mill) and  [goldfinch/harvest](https://github.com/goldfinch/harvest)

## License

The MIT License (MIT)
