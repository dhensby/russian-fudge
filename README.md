# Russian Fudge

A crowd-sourced directory for discovering and rating food spots — primarily focused on cake and baked goods. Built with [SilverStripe 3.2](https://www.silverstripe.org/) and the [Google Places API](https://developers.google.com/maps/documentation/places/web-service).

## Features

- **Spot discovery** — Search for nearby bakeries, cafes, restaurants, and other food venues via Google Places
- **Add spots** — Users can add new spots by searching Google Places and selecting a venue
- **Items and ratings** — Each spot can have food items, which users can rate and photograph
- **Tagging** — Items can be tagged for easy categorisation
- **Google Places sync** — Spot data (location, details) is automatically enriched from Google Places
- **Map-based search** — Frontend map interface for finding spots by location

## Tech Stack

| Component       | Technology                                    |
| --------------- | --------------------------------------------- |
| Framework       | SilverStripe 3.2 (PHP)                        |
| Database        | MariaDB (MySQL-compatible)                    |
| HTTP Client     | Guzzle 5.3 (with caching)                     |
| Frontend        | Bootstrap 4 (alpha), Sass, Grunt              |
| Dev Environment | Vagrant (CentOS 7.1, Apache, PHP 5.4)         |
| Package Mgmt    | Composer (PHP), Bower (frontend), npm (build)  |

## Data Model

```
Spot
├── Title, URLSegment, Latitude, Longitude
├── GooglePlaceID, GoogleData (cached from API)
├── AddedBy → Member
└── Items[]
    ├── Title
    ├── CreatedBy → Member
    ├── Tags[] (many-to-many)
    └── Ratings[]
        ├── Rating (1–5)
        └── Photo → Image
```

## Routes

| URL      | Controller       | Description              |
| -------- | ---------------- | ------------------------ |
| `/`      | RootController   | Homepage — lists spots   |
| `/spot`  | SpotController   | View or add a spot       |
| `/fe`    | FEController     | Frontend login           |

## Prerequisites

- [Vagrant](https://www.vagrantup.com/) and [VirtualBox](https://www.virtualbox.org/) (or another Vagrant provider)

## Getting Started

1. **Clone the repository:**

   ```sh
   git clone https://github.com/dhensby/russian-fudge.git
   cd russian-fudge
   ```

2. **Start the Vagrant VM:**

   ```sh
   vagrant up
   ```

   This provisions a CentOS 7.1 VM with Apache, PHP 5.4, MariaDB, Node.js, Bower, Grunt, Sass, and Mailcatcher. Composer dependencies are installed and SilverStripe is configured automatically.

3. **Access the site:**

   - **Website:** [http://localhost:8080](http://localhost:8080)
   - **Database:** `localhost:3306` (forwarded from guest)
   - **Mailcatcher:** [http://localhost:1080](http://localhost:1080)

4. **Default admin credentials:**

   - Username: `admin`
   - Password: `password`

## Theme Development

The frontend theme lives in `www/themes/default/` and uses Grunt for asset compilation.

```sh
# Inside the Vagrant VM
cd /vagrant/www/themes/default

# One-off Sass build
grunt

# Watch for changes with livereload
grunt dev
```

Sass source files are in `scss/` and compile to `css/main.css`.

## License

BSD License — Copyright (c) 2014 Better Brief LLP. See [LICENSE](LICENSE) for details.
