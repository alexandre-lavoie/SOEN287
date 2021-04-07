# WEO GraphQL

This section of the repo is for the GraphQL interface/port of the REST API.

## Usage

You will need to create a `.env` file in the root (or assigning the environment variables) with the contents:

```
baseUrl=https://url/to/api
```

You can then install and start GraphQL using:

```bash
npm i
npm run start # or dev for more hot-reload 
```

The terminal will reflect the env information and playground url (which should be at http://localhost:1337).