import { buildSchema } from 'type-graphql';
import { AccountResolver } from './account';
import { AisleResolver } from './aisle';
import { CartResolver } from './cart';
import { OrderResolver } from './order';
import { ProductResolver } from './product';
import { ProductStackResolver } from './productstack';
import { SplashResolver } from './splash';

export async function rootSchema(){
    return await buildSchema({
        resolvers: [
            AisleResolver,
            AccountResolver,
            CartResolver,
            OrderResolver,
            ProductResolver,
            ProductStackResolver,
            SplashResolver
        ],
    });
}