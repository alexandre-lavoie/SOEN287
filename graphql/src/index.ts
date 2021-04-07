import "reflect-metadata";
import * as dotenv from 'dotenv';

import express from 'express';
import cors from 'cors';
import { ApolloServer } from 'apollo-server-express';
import { rootSchema } from './api';
import { setBaseUrl } from "./api/rest";

async function bootstrap() {
    console.log("###############")
    console.log("# WEO GraphQL #")
    console.log("###############\n")

    dotenv.config();

    setBaseUrl(process.env.baseUrl);
    console.log(`API Base: ${process.env.baseUrl}`);

    const app = express();

    app.use(cors());

    const server = new ApolloServer({
        schema: await rootSchema(),
        playground: true
    });

    server.applyMiddleware({ app });

    app.listen({ port: 1337 }, () => {
        console.log(`GraphQL: http://localhost:1337${server.graphqlPath}`);
    });
}

bootstrap();