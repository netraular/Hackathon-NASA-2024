#ifndef CELESTIALBODYLIB_H
#define CELESTIALBODYLIB_H

#include <string>
#include <vector>
#include "DataLib.h"

class ExoPlanet;

class Star {
private:
    Data StarData;
    std::string name;
    double Light;

public:
    Star(std::string name, double distance, double RA, double DEC)
        : StarData(distance, RA, DEC), name(name) {}

    Data GetData() const { return StarData; }
    std::string GetName() const { return name; }
    double GetLight() const { return Light; }

    void SetData(const Data& data) { StarData = data; }
    void SetName(std::string name) { this->name = name; }
    void SetLight(double light) { this->Light = light; }
};

class ExoPlanet {
private:
    Data exoplanetData;
    std::string starName;
    std::string name;
    std::vector<Star>   stars[1999];

public:
    ExoPlanet(std::string starName, std::string name, double distance, double RA, double DEC)
        : exoplanetData(distance, RA, DEC), starName(starName), name(name){}

    Data ProjectBodyOverExoplanet(const Data& data) {
        return exoplanetData.SphericalTransData(data);
    }

    std::string GetName() const {
        return name;
    }

    std::string GetNameFirstStar() const {
        return this->stars->GetName();
    }

    void    push_star(Star newStar)
    {
        this->stars->push_back(newStar);
    }
};

#endif
