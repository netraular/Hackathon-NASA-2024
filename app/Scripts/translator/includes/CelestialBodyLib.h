#ifndef CELESTIALBODYLIB_H
#define CELESTIALBODYLIB_H

#include <string>
#include <vector>
#include "DataLib.h"
#include <iostream>

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
    double getDistance() const {
        return this->StarData.getDistance();
    }
    double getRA() const {
        return this->StarData.getRA();
    }
    double getDEC() const {
        return this->StarData.getDEC();
    }
    Data ProjectBodyOverStar(void) {
        return this->StarData.SphericalTransData(this->StarData);
    }
    void    realDistance(double distExo)
    {
        this->StarData.setDistance(this->StarData.ExoPlanetToStarDistance(distExo));
    }
    friend std::ostream& operator<<(std::ostream& os, const Star& st);
};

std::ostream& operator<<(std::ostream& os, const Star& st)
{
    os << st.name;
    return os;
}

class ExoPlanet {
private:
    Data exoplanetData;
    std::string starName;
    std::string name;
    std::vector<Star>   stars;

public:
    ExoPlanet(std::string starName, std::string name, double distance, double RA, double DEC)
        : exoplanetData(distance, RA, DEC), starName(starName), name(name){}

    void ProjectBodyOverExoplanet(void) {
        std::vector<Star>::iterator begin = stars.begin();
        std::vector<Star>::iterator end = stars.end();

        for (; begin != end; begin++)
        {
            begin->SetData(this->exoplanetData.SphericalTransData(begin->GetData()));
            begin->realDistance(this->exoplanetData.getDistance());
        }
    }

    std::string GetName() const {
        return this->name;
    }
    std::string GetStarName() const {
        return this->starName;
    }
    double getDistance() const {
        return this->exoplanetData.getDistance();
    }
    double getRA() const {
        return this->exoplanetData.getRA();
    }
    double getDEC() const {
        return this->exoplanetData.getDEC();
    }
    std::vector<Star>   getStars( void )
    {
        return this->stars;
    }

    std::string GetNameFirstStar() const {
        return this->stars[0].GetName();
    }

    void    push_star(Star newStar)
    {
        this->stars.push_back(newStar);
    }
};

#endif
