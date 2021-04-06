import "reflect-metadata";
import express from 'express';
import cors from 'cors';
import { ApolloServer } from 'apollo-server-express';
import { rootSchema } from './api';

async function bootstrap() {
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