import { ObjectType, Field, ID, Resolver, Query, Arg, InputType, Mutation, FieldResolver, Root, createUnionType } from 'type-graphql';
import { DELETE, Endpoint, GET, POST, PUT } from './rest';

@ObjectType()
export default class Splash {
    @Field(type => ID)
    public id: string;

    @Field()
    public title: string;

    @Field()
    public description: string;

    @Field()
    public image: string;
}

@InputType()
export class SplashCreate {
    @Field()
    public title: string;

    @Field()
    public description: string;

    @Field()
    public image: string;
}

@InputType()
export class SplashUpdate {
    @Field(type => ID)
    public id: string;

    @Field({ nullable: true })
    public title?: string;

    @Field({ nullable: true })
    public description?: string;

    @Field({ nullable: true })
    public image?: string;
}

@Resolver(of => Splash)
export class SplashResolver {
    @Query(returns => Splash)
    async splash(@Arg("id") id: string): Promise<Splash> {
        const json = await GET(Endpoint.splashs, { id });
        const splash = json.splashs[id] as any;

        return splash ? { ...splash, title: splash.name } : undefined;
    }

    @Query(returns => [Splash])
    async splashs(): Promise<Splash[]> {
        const json = await GET(Endpoint.splashs);

        return Object.values(json.splashs).map((splash: any) => ({ ...splash, title: splash.name }));
    }

    @Mutation(returns => Splash)
    async createSplash(@Arg("input") input: SplashCreate) {
        const splash = await POST(Endpoint.splashs, { ...input, name: input.title });

        return splash ? { ...splash, title: splash.name } : undefined;
    }

    @Mutation(returns => Splash)
    async updateSplash(@Arg("input") input: SplashUpdate) {
        const splash = await PUT(Endpoint.splashs, { ...input, name: input.title });

        return splash ? { ...splash, title: splash.name } : undefined;
    }

    @Mutation(returns => Splash)
    async deleteSplash(@Arg("id") id: string) {
        const splash = await this.splash(id);

        if (splash == undefined) return undefined;

        await DELETE(Endpoint.splashs, splash.id);

        return splash;
    }
}